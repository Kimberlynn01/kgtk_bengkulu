<?php

namespace App\Http\Controllers\Panel;

use App\Models\QnaCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\QnA\QnaCategoryStoreRequest;
use App\Http\Requests\Panel\QnA\QnaCategoryUpdateRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QnaCategoryController extends Controller
{
    public function list()
    {
        return view('contents.qna-category.list', [
            'title'      => 'Kategori QnA',
            'activeSlug' => 'qna',
        ]);
    }

    public function datatable()
    {
        $data = QnaCategory::withCount('qnas')->orderBy('sort_order')->orderBy('name')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return $row->is_active
                    ? '<span class="badge bg-success">Aktif</span>'
                    : '<span class="badge bg-secondary">Nonaktif</span>';
            })
            ->addColumn('action', function ($row) {
                $btn  = '<div class="btn-group">';
                $btn .= '<button class="btn btn-primary btn-sm btn-edit" data-id="' . $row->id . '" data-name="' . e($row->name) . '" data-active="' . (int) $row->is_active . '" title="Edit"><i class="icofont icofont-ui-edit"></i></button>';
                $btn .= '<button class="btn btn-danger btn-sm btn-delete" data-id="' . $row->id . '" title="Hapus"><i class="icofont icofont-trash"></i></button>';
                $btn .= '</div>';
                return $btn;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function store(QnaCategoryStoreRequest $request)
    {
        $validated = $request->validated();

        QnaCategory::create($validated + ['is_active' => true]);

        return response()->json(['message' => 'Kategori berhasil ditambahkan!']);
    }

    public function update(QnaCategoryUpdateRequest $request)
    {
        $validated = $request->validated();

        QnaCategory::findOrFail($validated['id'])->update([
            'name'      => $validated['name'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return response()->json(['message' => 'Kategori berhasil diperbarui!']);
    }

    public function delete(Request $request)
    {
        $category = QnaCategory::withCount('qnas')->findOrFail($request->id);

        if ($category->qnas_count > 0) {
            return response()->json([
                'message' => 'Kategori tidak bisa dihapus karena masih digunakan di data QnA.',
            ], 422);
        }

        $category->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus!']);
    }
}