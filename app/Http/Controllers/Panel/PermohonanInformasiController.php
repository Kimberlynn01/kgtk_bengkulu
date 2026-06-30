<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PermohonanInformasi\PermohonanInformasiStoreRequest;
use App\Http\Requests\Panel\PermohonanInformasi\PermohonanInformasiUpdateRequest;
use App\Models\PermohonanInformasi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PermohonanInformasiController extends Controller
{
    public function list()
    {
        return view('contents.permohonan_informasi.list', [
            'title' => 'Permohonan Informasi',
            'plugins' => ['datatable'],
        ]);
    }

    public function datatable()
    {
        return DataTables::of(PermohonanInformasi::query())
            ->addIndexColumn()
            ->addColumn('action', fn($row) => '')
            ->make(true);
    }

    public function store(PermohonanInformasiStoreRequest $request)
    {
        try {
            DB::transaction(fn() => PermohonanInformasi::create($request->validated()));
            return response()->json(['status' => true, 'message' => 'Permohonan Informasi berhasil disimpan'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            return response()->json(['status' => true, 'data' => PermohonanInformasi::findOrFail($id)], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(PermohonanInformasiUpdateRequest $request)
    {
        try {
            $item = PermohonanInformasi::findOrFail($request->id);
            DB::transaction(fn() => $item->update($request->validated()));
            return response()->json(['status' => true, 'message' => 'Permohonan Informasi berhasil diupdate'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $item = PermohonanInformasi::findOrFail($request->id);
            DB::transaction(fn() => $item->delete());
            return response()->json(['status' => true, 'message' => 'Permohonan Informasi berhasil dihapus'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
