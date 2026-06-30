<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PermohonanSaranaPrasarana\PermohonanSaranaPrasaranaStoreRequest;
use App\Http\Requests\Panel\PermohonanSaranaPrasarana\PermohonanSaranaPrasaranaUpdateRequest;
use App\Models\PermohonanSaranaPrasarana;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PermohonanSaranaPrasaranaController extends Controller
{
    public function list()
    {
        return view('contents.permohonan_sarana_prasarana.list', [
            'title' => 'Permohonan Pemanfaatan Sarana dan Prasarana',
            'plugins' => ['datatable'],
        ]);
    }

    public function datatable()
    {
        return DataTables::of(PermohonanSaranaPrasarana::query())
            ->addIndexColumn()
            ->addColumn('action', fn($row) => '')
            ->make(true);
    }

    public function store(PermohonanSaranaPrasaranaStoreRequest $request)
    {
        try {
            DB::transaction(fn() => PermohonanSaranaPrasarana::create($request->validated()));
            return response()->json(['status' => true, 'message' => 'Permohonan Sarana & Prasarana berhasil disimpan'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            return response()->json(['status' => true, 'data' => PermohonanSaranaPrasarana::findOrFail($id)], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(PermohonanSaranaPrasaranaUpdateRequest $request)
    {
        try {
            $item = PermohonanSaranaPrasarana::findOrFail($request->id);
            DB::transaction(fn() => $item->update($request->validated()));
            return response()->json(['status' => true, 'message' => 'Permohonan Sarana & Prasarana berhasil diupdate'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $item = PermohonanSaranaPrasarana::findOrFail($request->id);
            DB::transaction(fn() => $item->delete());
            return response()->json(['status' => true, 'message' => 'Permohonan Sarana & Prasarana berhasil dihapus'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
