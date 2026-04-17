<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\TugasFungsi\TugasFungsiStoreRequest;
use App\Http\Requests\Panel\TugasFungsi\TugasFungsiUpdateRequest;
use App\Models\TugasFungsi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TugasFungsiController extends Controller
{
    public function list()
    {
        return view('contents.tugas_fungsi.list', [
            'title' => 'Daftar Tugas Fungsi',
            'plugins' => ['datatable']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(TugasFungsi::query())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(TugasFungsiStoreRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                if ($request->hasFile('image')) {
                    $data['image'] = $request->file('image')->store('tugas_fungsis', 'public');
                }
                TugasFungsi::create($data);
            });
            return response()->json(['status' => true, 'message' => 'Tugas Fungsi berhasil disimpan'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $tugasFungsi = TugasFungsi::findOrFail($id);
            return response()->json(['status' => true, 'data' => $tugasFungsi], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(TugasFungsiUpdateRequest $request)
    {
        try {
            $tugasFungsi = TugasFungsi::findOrFail($request->id);
            DB::transaction(function () use ($tugasFungsi, $request) {
                $data = $request->validated();
                if ($request->hasFile('image')) {
                    if ($tugasFungsi->image) {
                        Storage::disk('public')->delete($tugasFungsi->image);
                    }
                    $data['image'] = $request->file('image')->store('tugas_fungsis', 'public');
                }
                $tugasFungsi->update($data);
            });
            return response()->json(['status' => true, 'message' => 'Tugas Fungsi berhasil diupdate'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $tugasFungsi = TugasFungsi::findOrFail($request->id);
            DB::transaction(function () use ($tugasFungsi) {
                if ($tugasFungsi->image) {
                    Storage::disk('public')->delete($tugasFungsi->image);
                }
                $tugasFungsi->delete();
            });
            return response()->json(['status' => true, 'message' => 'Tugas Fungsi berhasil dihapus'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
