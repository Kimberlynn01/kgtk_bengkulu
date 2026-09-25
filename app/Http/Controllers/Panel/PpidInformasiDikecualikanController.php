<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PPID\InformasiDikecualikan\PpidInformasiDikecualikanStoreRequest;
use App\Http\Requests\Panel\PPID\InformasiDikecualikan\PpidInformasiDikecualikanUpdateRequest;
use App\Models\PpidInformasiDikecualikan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PpidInformasiDikecualikanController extends Controller
{
    public function list()
    {
        return view('contents.ppid.informasi_dikecualikan.list', [
            'title' => 'PPID - Informasi Dikecualikan',
            'plugins' => ['datatable']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(PpidInformasiDikecualikan::query()->latest())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(PpidInformasiDikecualikanStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $path = $request->file('file')->store('ppid/informasi-dikecualikan', 'public');

                PpidInformasiDikecualikan::create([
                    'nama_dokumen' => $request->nama_dokumen,
                    'tahun'        => $request->tahun,
                    'file'         => $path,
                ]);

                return response()->json(['status' => true, 'message' => 'Informasi Dikecualikan berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $data = PpidInformasiDikecualikan::findOrFail($id);
            return response()->json(['status' => true, 'data' => $data], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(PpidInformasiDikecualikanUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = PpidInformasiDikecualikan::findOrFail($request->id);

                $updateData = [
                    'nama_dokumen' => $request->nama_dokumen,
                    'tahun'        => $request->tahun,
                ];

                if ($request->hasFile('file')) {
                    if ($data->file) {
                        Storage::disk('public')->delete($data->file);
                    }
                    $updateData['file'] = $request->file('file')->store('ppid/informasi-dikecualikan', 'public');
                }

                $data->update($updateData);

                return response()->json(['status' => true, 'message' => 'Informasi Dikecualikan berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = PpidInformasiDikecualikan::findOrFail($request->id);

                if ($data->file) {
                    Storage::disk('public')->delete($data->file);
                }

                $data->delete();

                return response()->json(['status' => true, 'message' => 'Informasi Dikecualikan berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}