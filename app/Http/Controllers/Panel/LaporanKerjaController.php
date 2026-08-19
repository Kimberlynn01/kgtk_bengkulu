<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\LaporanKerja\LaporanKerjaStoreRequest;
use App\Http\Requests\Panel\LaporanKerja\LaporanKerjaUpdateRequest;
use App\Models\LaporanKerja;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class LaporanKerjaController extends Controller
{
    public function list()
    {
        return view('contents.laporan_kerja.list', [
            'title' => 'Daftar Laporan Kerja',
            'plugins' => ['datatable']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(LaporanKerja::query())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(LaporanKerjaStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = $request->only(['title', 'description']);

                if ($request->hasFile('pdf')) {
                    $data['pdf'] = $request->file('pdf')->store('laporan_kerjas', 'public');
                }

                LaporanKerja::create($data);

                return response()->json(['status' => true, 'message' => 'Laporan Kerja berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $laporan_kerja = LaporanKerja::findOrFail($id);
            return response()->json(['status' => true, 'data' => $laporan_kerja], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(LaporanKerjaUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $laporan_kerja = LaporanKerja::findOrFail($request->id);
                $data = $request->only(['title', 'description']);

                if ($request->hasFile('pdf')) {
                    if ($laporan_kerja->pdf) {
                        Storage::disk('public')->delete($laporan_kerja->pdf);
                    }
                    $data['pdf'] = $request->file('pdf')->store('laporan_kerjas', 'public');
                }

                $laporan_kerja->update($data);

                return response()->json(['status' => true, 'message' => 'Laporan Kerja berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $laporan_kerja = LaporanKerja::findOrFail($request->id);

                if ($laporan_kerja->pdf) {
                    Storage::disk('public')->delete($laporan_kerja->pdf);
                }

                $laporan_kerja->delete();

                return response()->json(['status' => true, 'message' => 'Laporan Kerja berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
