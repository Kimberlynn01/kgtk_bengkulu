<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PPID\LayananInformasi\PpidLayananInformasiStoreRequest;
use App\Http\Requests\Panel\PPID\LayananInformasi\PpidLayananInformasiUpdateRequest;
use App\Models\PpidLayananInformasi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PpidLayananInformasiController extends Controller
{
    public function list()
    {
        return view('contents.ppid.layanan_informasi.list', [
            'title' => 'PPID - Layanan Informasi',
            'plugins' => ['datatable']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(PpidLayananInformasi::query()->latest())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(PpidLayananInformasiStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $path = $request->file('file')->store('ppid/layanan-informasi', 'public');

                PpidLayananInformasi::create([
                    'nama_dokumen' => $request->nama_dokumen,
                    'tahun'        => $request->tahun,
                    'file'         => $path,
                ]);

                return response()->json(['status' => true, 'message' => 'Layanan Informasi berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $data = PpidLayananInformasi::findOrFail($id);
            return response()->json(['status' => true, 'data' => $data], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(PpidLayananInformasiUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = PpidLayananInformasi::findOrFail($request->id);

                $updateData = [
                    'nama_dokumen' => $request->nama_dokumen,
                    'tahun'        => $request->tahun,
                ];

                if ($request->hasFile('file')) {
                    if ($data->file) {
                        Storage::disk('public')->delete($data->file);
                    }
                    $updateData['file'] = $request->file('file')->store('ppid/layanan-informasi', 'public');
                }

                $data->update($updateData);

                return response()->json(['status' => true, 'message' => 'Layanan Informasi berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = PpidLayananInformasi::findOrFail($request->id);

                if ($data->file) {
                    Storage::disk('public')->delete($data->file);
                }

                $data->delete();

                return response()->json(['status' => true, 'message' => 'Layanan Informasi berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}