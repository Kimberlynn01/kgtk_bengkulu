<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PermohonanKerjaSama\PermohonanKerjaSamaStoreRequest;
use App\Http\Requests\Panel\PermohonanKerjaSama\PermohonanKerjaSamaUpdateRequest;
use App\Models\PermohonanKerjaSama;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PermohonanKerjaSamaController extends Controller
{
    public function list()
    {
        return view('contents.permohonan_kerja_sama.list', [
            'title' => 'Permohonan Kerja Sama',
            'plugins' => ['datatable'],
        ]);
    }

    public function datatable()
    {
        return DataTables::of(PermohonanKerjaSama::query())
            ->addIndexColumn()
            ->addColumn('action', fn($row) => '')
            ->make(true);
    }

    public function store(PermohonanKerjaSamaStoreRequest $request)
    {
        try {
            DB::transaction(fn() => PermohonanKerjaSama::create($request->validated()));
            return response()->json(['status' => true, 'message' => 'Permohonan Kerja Sama berhasil disimpan'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            return response()->json(['status' => true, 'data' => PermohonanKerjaSama::findOrFail($id)], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(PermohonanKerjaSamaUpdateRequest $request)
    {
        try {
            $item = PermohonanKerjaSama::findOrFail($request->id);
            DB::transaction(fn() => $item->update($request->validated()));
            return response()->json(['status' => true, 'message' => 'Permohonan Kerja Sama berhasil diupdate'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $item = PermohonanKerjaSama::findOrFail($request->id);
            DB::transaction(fn() => $item->delete());
            return response()->json(['status' => true, 'message' => 'Permohonan Kerja Sama berhasil dihapus'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
