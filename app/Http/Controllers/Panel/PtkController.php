<?php

namespace App\Http\Controllers\Panel;

use App\Models\Ptk;
use App\Models\PtkField;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Ptk\PtkStoreRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use Illuminate\Support\Facades\Cache;

class PtkController extends Controller
{
    private function clearRecapCache(): void
    {
        Cache::forget('ptk_recap_api_jenjang_jabatan');
        Cache::forget('ptk_recap_api_jabatan_jenjang');
    }

    public function list()
    {
        return view('contents.ptk.list', [
            'title'      => 'Data Pendidik & Tenaga Kependidikan',
            'activeSlug' => 'ptk',
            'fields'     => PtkField::orderBy('sort_order')->get(),
        ]);
    }

    public function datatable()
    {
        $fields = PtkField::orderBy('sort_order')->get();
        $data   = Ptk::latest()->get();

        $dt = DataTables::of($data)->addIndexColumn();

        foreach ($fields as $field) {
            $dt->addColumn($field->key, fn ($row) => e($row->value($field->key) ?? '-'));
        }

        $dt->addColumn('jumlah', fn ($row) => number_format($row->jumlah, 0, ',', '.'));


        $dt->addColumn('action', function ($row) {
            $btn = '<div class="btn-group">';
            if (rbacCheck('ptk', 3)) {
                $btn .= '<button class="btn btn-primary btn-sm btn-edit" data-id="' . $row->id . '" title="Edit"><i class="icofont icofont-ui-edit"></i></button>';
            }
            if (rbacCheck('ptk', 4)) {
                $btn .= '<button class="btn btn-danger btn-sm btn-delete" data-id="' . $row->id . '" title="Hapus"><i class="icofont icofont-trash"></i></button>';
            }
            $btn .= '</div>';
            return $btn;
        });

        return $dt->rawColumns(['action'])->make(true);
    }

    public function edit($id)
    {
        return response()->json(Ptk::findOrFail($id));
    }

    public function store(PtkStoreRequest $request)
    {
        Ptk::create([
            'data'   => $request->input('fields', []),
            'jumlah' => $request->input('jumlah', 0),
        ]);

        $this->clearRecapCache();

        return response()->json(['message' => 'Data berhasil ditambahkan!']);
    }


    public function update(PtkStoreRequest $request, $id)
    {
        Ptk::findOrFail($id)->update([
            'data'   => $request->input('fields', []),
            'jumlah' => $request->input('jumlah', 0),
        ]);

        $this->clearRecapCache();

        return response()->json(['message' => 'Data berhasil diperbarui!']);
    }

    public function delete(Request $request)
    {
        Ptk::findOrFail($request->id)->delete();

        $this->clearRecapCache();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }


    public function importTemplate()
    {
        $fields = PtkField::orderBy('sort_order')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->setTitle('Template Import PTK');
        $sheet = $spreadsheet->getActiveSheet();

        $headers = $fields->pluck('label')->push('Jumlah')->toArray();

        foreach ($headers as $i => $h) {
            $col = Coordinate::stringFromColumnIndex($i + 1);
            $sheet->setCellValue("{$col}1", $h);
        }

        $lastCol = Coordinate::stringFromColumnIndex(count($headers));

        $sheet->getStyle("A1:{$lastCol}1")->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'name' => 'Arial', 'size' => 11],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => '1B4F72']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '95A5A6']]],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(28);

        
        foreach ($fields as $i => $field) {
            $col = Coordinate::stringFromColumnIndex($i + 1);
            $example = match ($field->type) {
                'select' => $field->options[0] ?? '',
                'number' => 1,
                'date'   => now()->format('Y-m-d'),
                default  => 'Contoh',
            };
            $sheet->setCellValue("{$col}2", $example);
        }
        $sheet->setCellValue("{$lastCol}2", 100);
        
        foreach ($fields as $i => $field) {
            if ($field->type === 'select' && !empty($field->options)) {
                $col = Coordinate::stringFromColumnIndex($i + 1);
                $optionsList = '"' . implode(',', $field->options) . '"';

                for ($row = 2; $row <= 200; $row++) {
                    $validation = $sheet->getCell("{$col}{$row}")->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST);
                    $validation->setErrorStyle(DataValidation::STYLE_STOP);
                    $validation->setAllowBlank(false);
                    $validation->setShowDropDown(true);
                    $validation->setFormula1($optionsList);
                }
            }
        }

        foreach (range('A', $lastCol) as $col) {
            $sheet->getColumnDimension($col)->setWidth(20);
        }
        $sheet->freezePane('A2');

        $filename = 'Template_Import_PTK_' . now()->format('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
        header('Cache-Control: max-age=0');

        (new XlsxWriter($spreadsheet))->save('php://output');
        exit;
    }

    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:5120',
        ]);

        $fields = PtkField::orderBy('sort_order')->get();

        $spreadsheet = (new XlsxReader())->load($request->file('file')->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        $headerRow = array_shift($rows); 

        $success = 0;
        $errors  = [];

        foreach ($rows as $rowIndex => $row) {
            $excelRowNumber = $rowIndex + 1; 

            $rowValues = array_values($row);

            
            if (collect($rowValues)->filter(fn ($v) => trim((string) $v) !== '')->isEmpty()) {
                continue;
            }

            $data = [];
            $rowErrors = [];

            foreach ($fields as $i => $field) {
                $value = trim((string) ($rowValues[$i] ?? ''));

                if ($field->is_required && $value === '') {
                    $rowErrors[] = "{$field->label} wajib diisi";
                    continue;
                }

                if ($field->type === 'select' && $value !== '' && !in_array($value, $field->options ?? [])) {
                    $rowErrors[] = "{$field->label} '{$value}' tidak valid (pilihan: " . implode(', ', $field->options ?? []) . ")";
                    continue;
                }

                $data[$field->key] = $value;
            }

            $jumlahRaw = trim((string) ($rowValues[$fields->count()] ?? '0'));
            $jumlah = is_numeric($jumlahRaw) ? (int) $jumlahRaw : null;

            if ($jumlah === null) {
                $rowErrors[] = "Jumlah harus berupa angka";
            }

            if (!empty($rowErrors)) {
                $errors[] = "Baris {$excelRowNumber}: " . implode('; ', $rowErrors);
                continue;
            }

            Ptk::create([
                'data'   => $data,
                'jumlah' => $jumlah,
            ]);

            $success++;
        }

        $this->clearRecapCache();

        return response()->json([
            'message' => "{$success} baris berhasil diimport." . (count($errors) ? " " . count($errors) . " baris gagal." : ""),
            'success_count' => $success,
            'errors' => $errors,
        ]);
    }


    
}