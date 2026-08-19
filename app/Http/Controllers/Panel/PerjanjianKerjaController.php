<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PerjanjianKerja\PerjanjianKerjaStoreRequest;
use App\Http\Requests\Panel\PerjanjianKerja\PerjanjianKerjaUpdateRequest;
use App\Models\PerjanjianKerja;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PerjanjianKerjaController extends Controller
{
    public function list()
    {
        return view('contents.perjanjian_kerja.list', [
            'title' => 'Daftar Perjanjian Kerja',
            'plugins' => ['datatable']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(PerjanjianKerja::query())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(PerjanjianKerjaStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = $request->only(['title', 'description']);

                if ($request->hasFile('pdf')) {
                    $data['pdf'] = $request->file('pdf')->store('perjanjian_kerjas', 'public');
                }

                PerjanjianKerja::create($data);

                return response()->json(['status' => true, 'message' => 'Perjanjian Kerja berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $perjanjian_kerja = PerjanjianKerja::findOrFail($id);
            return response()->json(['status' => true, 'data' => $perjanjian_kerja], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(PerjanjianKerjaUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $perjanjian_kerja = PerjanjianKerja::findOrFail($request->id);
                $data = $request->only(['title', 'description']);

                if ($request->hasFile('pdf')) {
                    if ($perjanjian_kerja->pdf) {
                        Storage::disk('public')->delete($perjanjian_kerja->pdf);
                    }
                    $data['pdf'] = $request->file('pdf')->store('perjanjian_kerjas', 'public');
                }

                $perjanjian_kerja->update($data);

                return response()->json(['status' => true, 'message' => 'Perjanjian Kerja berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $perjanjian_kerja = PerjanjianKerja::findOrFail($request->id);

                if ($perjanjian_kerja->pdf) {
                    Storage::disk('public')->delete($perjanjian_kerja->pdf);
                }

                $perjanjian_kerja->delete();

                return response()->json(['status' => true, 'message' => 'Perjanjian Kerja berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
