<?php

namespace App\Http\Controllers\Panel;

use App\Models\Qna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use App\Mail\QnaAnsweredMail;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class QnaController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'instansi' => 'required|string|max:255',
            'phone'    => 'required|numeric',
            'category' => ['required', Rule::in(['ppg','bcks','bcps','pkgbk','pkgsd mbi','stem','pm/kka','ukkj','gpk mahir'])],
            'question' => 'required|string',
        ]);

        Qna::create($validated);

        return back()->with('success', 'Pertanyaan Anda berhasil dikirim! Mohon tunggu jawaban dari Admin.');
    }

    public function list()
    {
        return view('contents.qna.list', [
            'title'      => 'Manajemen QnA',
            'activeSlug' => 'qna',
        ]);
    }

    public function datatable()
    {
        $data = Qna::with('admin')->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return $row->answer
                    ? '<span class="badge bg-success">Terjawab</span>'
                    : '<span class="badge bg-warning text-dark">Pending</span>';
            })
            ->addColumn('answer_preview', function ($row) {
                if (!$row->answer) {
                    return '<span class="text-muted fst-italic small">Belum dijawab</span>';
                }
                return '<span class="d-inline-block text-truncate" style="max-width:200px;" 
                              title="' . e($row->answer) . '">'
                            . \Str::limit($row->answer, 60)
                        . '</span>';
            })
            ->addColumn('asked_at', function ($row) {
                return $row->created_at
                    ? '<span class="small">' . $row->created_at->format('d/m/Y') . '<br><span class="text-muted">' . $row->created_at->format('H:i') . '</span></span>'
                    : '-';
            })
            ->addColumn('answered_at_col', function ($row) {
                if (!$row->answered_at) return '<span class="text-muted">-</span>';
                return '<span class="small">' . $row->answered_at->format('d/m/Y') . '<br><span class="text-muted">' . $row->answered_at->format('H:i') . '</span></span>';
            })
            ->addColumn('action', function ($row) {
                $btn  = '<button class="btn btn-primary btn-sm btn-edit" data-id="' . $row->id . '"><i class="fa fa-pencil"></i> Jawab</button> ';
                $btn .= '<button class="btn btn-danger btn-sm btn-delete" data-id="' . $row->id . '"><i class="fa fa-trash"></i> Hapus</button>';
                return $btn;
            })
            ->rawColumns(['status', 'answer_preview', 'asked_at', 'answered_at_col', 'action'])
            ->make(true);
    }

    public function edit($id)
    {
        return response()->json(Qna::findOrFail($id));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'     => 'required|exists:qnas,id',
            'answer' => 'required',
        ]);

        $qna = Qna::findOrFail($request->id);
        $qna->update([
            'answer'      => $request->answer,
            'user_id'     => auth()->id(),
            'answered_at' => now(),      // ← catat waktu dijawab
        ]);

        try {
            Mail::to($qna->email)->send(new QnaAnsweredMail($qna));
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim email QnA: ' . $e->getMessage());
        }

        return response()->json(['message' => 'Jawaban berhasil disimpan dan email telah dikirim!']);
    }

    public function delete(Request $request)
    {
        Qna::findOrFail($request->id)->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }

    // ─────────────────────────────────────────────────────────────────
    // EXPORT EXCEL
    // ─────────────────────────────────────────────────────────────────
    public function export()
    {
        $data = Qna::with('admin')->latest()->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->setTitle('Data QnA');
        $sheet = $spreadsheet->getActiveSheet();

        // ── Header ──────────────────────────────────────────────────
        $headers = [
            'No', 'Nama Penanya', 'Email', 'Instansi', 'No. HP',
            'Kategori', 'Pertanyaan', 'Jawaban', 'Status',
            'Waktu Bertanya', 'Waktu Dijawab', 'Dijawab Oleh',
        ];

        foreach ($headers as $i => $h) {
            $col = Coordinate::stringFromColumnIndex($i + 1);
            $sheet->setCellValue("{$col}1", $h);
        }

        $lastCol    = Coordinate::stringFromColumnIndex(count($headers));
        $headerRange = "A1:{$lastCol}1";

        $sheet->getStyle($headerRange)->applyFromArray([
            'font' => [
                'bold'  => true,
                'color' => ['rgb' => 'FFFFFF'],
                'name'  => 'Arial',
                'size'  => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color'    => ['rgb' => '1B4F72'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
                'wrapText'   => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color'       => ['rgb' => '95A5A6'],
                ],
            ],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(32);

        // ── Rows ─────────────────────────────────────────────────────
        foreach ($data as $i => $row) {
            $r      = $i + 2;
            $status = $row->answer ? 'Terjawab' : 'Pending';

            $sheet->setCellValue("A{$r}", $i + 1);
            $sheet->setCellValue("B{$r}", $row->name);
            $sheet->setCellValue("C{$r}", $row->email);
            $sheet->setCellValue("D{$r}", $row->instansi);
            $sheet->setCellValue("E{$r}", $row->phone);
            $sheet->setCellValue("F{$r}", strtoupper($row->category));
            $sheet->setCellValue("G{$r}", $row->question);
            $sheet->setCellValue("H{$r}", $row->answer ?? '-');
            $sheet->setCellValue("I{$r}", $status);
            $sheet->setCellValue("J{$r}", $row->created_at ? $row->created_at->format('d/m/Y H:i') : '-');
            $sheet->setCellValue("K{$r}", $row->answered_at ? $row->answered_at->format('d/m/Y H:i') : '-');
            $sheet->setCellValue("L{$r}", optional($row->admin)->name ?? '-');

            // Alternating row color
            $bgColor = ($i % 2 === 0) ? 'EBF5FB' : 'FFFFFF';

            $sheet->getStyle("A{$r}:L{$r}")->applyFromArray([
                'font'      => ['name' => 'Arial', 'size' => 10],
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => $bgColor]],
                'borders'   => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D5D8DC']],
                ],
                'alignment' => ['vertical' => Alignment::VERTICAL_TOP, 'wrapText' => true],
            ]);

            // Warna status
            if ($row->answer) {
                $sheet->getStyle("I{$r}")->applyFromArray([
                    'fill'      => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'D5F5E3']],
                    'font'      => ['color' => ['rgb' => '1E8449'], 'bold' => true],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
            } else {
                $sheet->getStyle("I{$r}")->applyFromArray([
                    'fill'      => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'FEF9E7']],
                    'font'      => ['color' => ['rgb' => 'B7950B'], 'bold' => true],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
            }

            // Center: No, Kategori, Status, Waktu
            foreach (['A', 'F', 'J', 'K'] as $c) {
                $sheet->getStyle("{$c}{$r}")->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }

            $sheet->getRowDimension($r)->setRowHeight(22);
        }

        // ── Column widths ─────────────────────────────────────────────
        $widths = [
            'A' => 5,  'B' => 22, 'C' => 28, 'D' => 22,
            'E' => 14, 'F' => 12, 'G' => 38, 'H' => 42,
            'I' => 12, 'J' => 16, 'K' => 16, 'L' => 20,
        ];
        foreach ($widths as $col => $w) {
            $sheet->getColumnDimension($col)->setWidth($w);
        }

        // Freeze header row
        $sheet->freezePane('A2');

        // ── Download ──────────────────────────────────────────────────
        $filename = 'QnA_Export_' . now()->format('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
        header('Cache-Control: max-age=0');

        (new Xlsx($spreadsheet))->save('php://output');
        exit;
    }

    public function datatableAnswered()
{
    $data = Qna::with('admin')
        ->whereNotNull('answer')
        ->latest('updated_at')
        ->get();

    return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('asked_at', function ($row) {
            return '<span class="small">'
                . $row->created_at->format('d/m/Y')
                . '<br><span class="text-muted">'
                . $row->created_at->format('H:i')
                . '</span></span>';
        })
        ->addColumn('answered_at_col', function ($row) {
            return '<span class="small">'
                . $row->updated_at->format('d/m/Y')
                . '<br><span class="text-muted">'
                . $row->updated_at->format('H:i')
                . '</span></span>';
        })
        ->addColumn('admin_name', function ($row) {
            return optional($row->admin)->name ?? '-';
        })
        ->rawColumns(['asked_at', 'answered_at_col'])
        ->make(true);
}
}