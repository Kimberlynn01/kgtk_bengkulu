<?php

namespace App\Http\Controllers\Panel;

use App\Models\Ptk;
use App\Models\PtkField;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class PtkRecapController extends Controller
{
    public function index()
    {
        return view('contents.ptk-recap.list', [
            'title'      => 'Rekapitulasi Data PTK',
            'activeSlug' => 'ptk',
            'filterFields' => PtkField::where('is_filterable', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function generate(Request $request)
    {
        $request->validate([
            'row_key' => 'required|string|exists:ptk_fields,key',
            'col_key' => 'required|string|exists:ptk_fields,key|different:row_key',
        ]);

        $rowField = PtkField::where('key', $request->row_key)->firstOrFail();
        $colField = PtkField::where('key', $request->col_key)->firstOrFail();

        $rowOptions = $rowField->options ?? [];
        $colOptions = $colField->options ?? [];

        $matrix = [];
        foreach ($rowOptions as $r) {
            foreach ($colOptions as $c) {
                $matrix[$r][$c] = 0;
            }
        }

        $records = Ptk::all();
        foreach ($records as $rec) {
            $rVal = $rec->value($rowField->key);
            $cVal = $rec->value($colField->key);
            if ($rVal !== null && $cVal !== null && isset($matrix[$rVal][$cVal])) {
                $matrix[$rVal][$cVal] += $rec->jumlah;
            }
        }

        $rows = [];
        $colTotals = array_fill_keys($colOptions, 0);
        $grandTotal = 0;

        foreach ($rowOptions as $r) {
            $rowTotal = 0;
            $cells = [];
            foreach ($colOptions as $c) {
                $count = $matrix[$r][$c];
                $cells[$c] = $count;
                $rowTotal += $count;
                $colTotals[$c] += $count;
            }
            $rows[] = ['label' => $r, 'cells' => $cells, 'total' => $rowTotal];
            $grandTotal += $rowTotal;
        }

        return response()->json([
            'row_label'  => $rowField->label,
            'col_label'  => $colField->label,
            'columns'    => $colOptions,
            'rows'       => $rows,
            'col_totals' => $colTotals,
            'grand_total'=> $grandTotal,
        ]);
    }

    public function export(Request $request)
    {
        $request->validate([
            'row_key' => 'required|string|exists:ptk_fields,key',
            'col_key' => 'required|string|exists:ptk_fields,key|different:row_key',
        ]);

        $rowField = PtkField::where('key', $request->row_key)->firstOrFail();
        $colField = PtkField::where('key', $request->col_key)->firstOrFail();

        $rowOptions = $rowField->options ?? [];
        $colOptions = $colField->options ?? [];

        $matrix = [];
        foreach ($rowOptions as $r) {
            foreach ($colOptions as $c) {
                $matrix[$r][$c] = 0;
            }
        }

        foreach (Ptk::all() as $rec) {
            $rVal = $rec->value($rowField->key);
            $cVal = $rec->value($colField->key);
            if ($rVal !== null && $cVal !== null && isset($matrix[$rVal][$cVal])) {
                $matrix[$rVal][$cVal] += $rec->jumlah;
            }
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->setTitle('Rekap PTK');
        $sheet = $spreadsheet->getActiveSheet();

        // ── Header ──────────────────────────────────────────────────────
        $headers = array_merge([$rowField->label], $colOptions, ['Grand Total']);
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

        // ── Rows ────────────────────────────────────────────────────────
        $colTotals = array_fill_keys($colOptions, 0);
        $grandTotal = 0;

        foreach ($rowOptions as $i => $r) {
            $excelRow = $i + 2;
            $sheet->setCellValue("A{$excelRow}", $r);

            $rowTotal = 0;
            foreach ($colOptions as $j => $c) {
                $col = Coordinate::stringFromColumnIndex($j + 2);
                $count = $matrix[$r][$c];
                $sheet->setCellValue("{$col}{$excelRow}", $count);
                $rowTotal += $count;
                $colTotals[$c] += $count;
            }

            $totalCol = Coordinate::stringFromColumnIndex(count($colOptions) + 2);
            $sheet->setCellValue("{$totalCol}{$excelRow}", $rowTotal);
            $grandTotal += $rowTotal;

            $bgColor = ($i % 2 === 0) ? 'EBF5FB' : 'FFFFFF';
            $sheet->getStyle("A{$excelRow}:{$lastCol}{$excelRow}")->applyFromArray([
                'font'      => ['name' => 'Arial', 'size' => 10],
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => $bgColor]],
                'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D5D8DC']]],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            ]);
            $sheet->getStyle("A{$excelRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $sheet->getStyle("A{$excelRow}")->getFont()->setBold(true);
        }

        // ── Grand Total row ────────────────────────────────────────────
        $footerRow = count($rowOptions) + 2;
        $sheet->setCellValue("A{$footerRow}", 'Grand Total');
        foreach ($colOptions as $j => $c) {
            $col = Coordinate::stringFromColumnIndex($j + 2);
            $sheet->setCellValue("{$col}{$footerRow}", $colTotals[$c]);
        }
        $totalCol = Coordinate::stringFromColumnIndex(count($colOptions) + 2);
        $sheet->setCellValue("{$totalCol}{$footerRow}", $grandTotal);

        $sheet->getStyle("A{$footerRow}:{$lastCol}{$footerRow}")->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => '1B4F72'], 'name' => 'Arial', 'size' => 10],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'D5F5E3']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '95A5A6']]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        foreach (range('A', $lastCol) as $col) {
            $sheet->getColumnDimension($col)->setWidth(20);
        }
        $sheet->freezePane('B2');

        $filename = 'Rekap_PTK_' . strtolower($rowField->key) . '_' . strtolower($colField->key) . '_' . now()->format('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
        header('Cache-Control: max-age=0');

        (new Xlsx($spreadsheet))->save('php://output');
        exit;
    }
}