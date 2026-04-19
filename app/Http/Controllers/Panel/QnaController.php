<?php

namespace App\Http\Controllers\Panel;

use App\Models\Qna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class QnaController extends Controller
{
    /**
     * Menyimpan pertanyaan dari Guest (Landing Page)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'question' => 'required|string',
        ]);

        Qna::create($validated);

        return back()->with('success', 'Pertanyaan Anda berhasil dikirim! Mohon tunggu jawaban dari Admin.');
    }

    public function list()
    {
        $data = [
            'title' => 'Manajemen QnA',
            'activeSlug' => 'qna',
        ];
        return view('contents.qna.list', $data);
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
            ->addColumn('action', function ($row) {
                $btn = '<button class="btn btn-primary btn-sm btn-edit" data-id="'.$row->id.'"><i class="fa fa-pencil"></i> Jawab</button> ';
                $btn .= '<button class="btn btn-danger btn-sm btn-delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i> Hapus</button>';
                return $btn;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function edit($id)
    {
        $qna = Qna::findOrFail($id);
        return response()->json($qna);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'answer' => 'required',
        ]);

        $qna = Qna::findOrFail($request->id);
        $qna->update([
            'answer' => $request->answer,
            'user_id' => auth()->id(), // Mencatat admin yang menjawab
        ]);

        return response()->json(['message' => 'Jawaban berhasil disimpan!']);
    }

    public function delete(Request $request)
    {
        Qna::destroy($request->id);
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }

}
