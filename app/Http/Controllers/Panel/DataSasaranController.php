<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\DataSasaran\DataSasaranStoreRequest;
use App\Http\Requests\Panel\DataSasaran\DataSasaranUpdateRequest;
use App\Models\DataSasaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DataSasaranController extends Controller
{
    public function list()
    {
        return view('contents.data_sasaran.list', [
            'title' => 'Daftar Data Sasaran',
            'plugins' => ['datatable'],
        ]);
    }

    public function datatable()
    {
        return DataTables::of(DataSasaran::query())
            ->addIndexColumn()
            ->addColumn('action', fn($row) => '')
            ->make(true);
    }

    public function store(DataSasaranStoreRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                if ($request->hasFile('file')) {
                    $data['file'] = $request->file('file')->store('data_sasarans', 'public');
                }
                DataSasaran::create($data);
            });
            return response()->json(['status' => true, 'message' => 'Data Sasaran berhasil disimpan'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $data = DataSasaran::findOrFail($id);
            return response()->json(['status' => true, 'data' => $data], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(DataSasaranUpdateRequest $request)
    {
        try {
            $item = DataSasaran::findOrFail($request->id);
            DB::transaction(function () use ($item, $request) {
                $data = $request->validated();
                if ($request->hasFile('file')) {
                    if ($item->file) {
                        Storage::disk('public')->delete($item->file);
                    }
                    $data['file'] = $request->file('file')->store('data_sasarans', 'public');
                }
                $item->update($data);
            });
            return response()->json(['status' => true, 'message' => 'Data Sasaran berhasil diupdate'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $item = DataSasaran::findOrFail($request->id);
            DB::transaction(function () use ($item) {
                if ($item->file) {
                    Storage::disk('public')->delete($item->file);
                }
                $item->delete();
            });
            return response()->json(['status' => true, 'message' => 'Data Sasaran berhasil dihapus'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
