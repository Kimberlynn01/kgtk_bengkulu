<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PPID\TugasFungsi\PpidTugasFungsiStoreRequest;
use App\Http\Requests\Panel\PPID\TugasFungsi\PpidTugasFungsiUpdateRequest;
use App\Models\PpidTugasFungsi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PpidTugasFungsiController extends Controller
{
    public function list()
    {
        return view('contents.ppid.tugas_fungsi.list', [
            'title' => 'PPID - Tugas dan Fungsi',
            'plugins' => ['datatable']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(PpidTugasFungsi::query()->latest())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(PpidTugasFungsiStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $path = $request->file('image')->store('ppid/tugas-fungsi', 'public');

                PpidTugasFungsi::create([
                    'title'       => $request->title,
                    'description' => $request->description,
                    'image'       => $path,
                ]);

                return response()->json(['status' => true, 'message' => 'Tugas dan Fungsi PPID berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $data = PpidTugasFungsi::findOrFail($id);
            return response()->json(['status' => true, 'data' => $data], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(PpidTugasFungsiUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = PpidTugasFungsi::findOrFail($request->id);

                $updateData = [
                    'title'       => $request->title,
                    'description' => $request->description,
                ];

                if ($request->hasFile('image')) {
                    if ($data->image) {
                        Storage::disk('public')->delete($data->image);
                    }
                    $updateData['image'] = $request->file('image')->store('ppid/tugas-fungsi', 'public');
                }

                $data->update($updateData);

                return response()->json(['status' => true, 'message' => 'Tugas dan Fungsi PPID berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = PpidTugasFungsi::findOrFail($request->id);

                if ($data->image) {
                    Storage::disk('public')->delete($data->image);
                }

                $data->delete();

                return response()->json(['status' => true, 'message' => 'Tugas dan Fungsi PPID berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}