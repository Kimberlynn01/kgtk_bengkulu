<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PermohonanNarasumber\PermohonanNarasumberStoreRequest;
use App\Http\Requests\Panel\PermohonanNarasumber\PermohonanNarasumberUpdateRequest;
use App\Models\PermohonanNarasumber;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class PermohonanNarasumberController extends Controller
{
    public function list()
    {
        return view('contents.permohonan_narasumber.list', [
            'title' => 'Permohonan Narasumber',
            'plugins' => ['datatable'],
        ]);
    }

    public function datatable()
    {
        return DataTables::of(PermohonanNarasumber::query())
            ->addIndexColumn()
            ->addColumn('action', fn($row) => '')
            ->make(true);
    }
    public function store(PermohonanNarasumberStoreRequest $request)
    {
        try {
            DB::transaction(fn() => PermohonanNarasumber::create($request->validated()));
            return response()->json(['status' => true, 'message' => 'Permohonan Narasumber berhasil disimpan'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            return response()->json(['status' => true, 'data' => PermohonanNarasumber::findOrFail($id)], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(PermohonanNarasumberUpdateRequest $request)
    {
        try {
            $item = PermohonanNarasumber::findOrFail($request->id);
            DB::transaction(fn() => $item->update($request->validated()));
            return response()->json(['status' => true, 'message' => 'Permohonan Narasumber berhasil diupdate'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $item = PermohonanNarasumber::findOrFail($request->id);
            DB::transaction(fn() => $item->delete());
            return response()->json(['status' => true, 'message' => 'Permohonan Narasumber berhasil dihapus'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
