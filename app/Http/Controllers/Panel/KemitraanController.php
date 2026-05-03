<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Kemitraan\KemitraanStoreRequest;
use App\Http\Requests\Panel\Kemitraan\KemitraanUpdateRequest;
use App\Models\Kemitraan;
use App\Models\KemitraanFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class KemitraanController extends Controller
{
    public function list()
    {
        return view('contents.kemitraan.list', [
            'title' => 'Daftar Kemitraan',
            'plugins' => ['datatable']
        ]);
    }

    public function show()
    {
        $kemitraans = Kemitraan::all();

        return view('front.layanan.kemitraan', compact('kemitraans'));
    }

    public function datatable()
    {
        return DataTables::of(Kemitraan::query())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(KemitraanStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $kemitraan = Kemitraan::create($request->only(['title', 'description']));

                if ($request->hasFile('files')) {
                    foreach ($request->file('files') as $file) {
                        $path = $file->store('kemitraans', 'public');
                        $kemitraan->files()->create(['file' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Kemitraan berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $kemitraan = Kemitraan::with('files')->findOrFail($id);
            return response()->json(['status' => true, 'data' => $kemitraan], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(KemitraanUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $kemitraan = Kemitraan::findOrFail($request->id);
                $kemitraan->update($request->only(['title', 'description']));

                if ($request->filled('deleted_files')) {
                    foreach ($request->deleted_files as $fileId) {
                        $file = KemitraanFile::find($fileId);
                        if ($file) {
                            Storage::disk('public')->delete($file->file);
                            $file->delete();
                        }
                    }
                }

                if ($request->hasFile('files')) {
                    foreach ($request->file('files') as $file) {
                        $path = $file->store('kemitraans', 'public');
                        $kemitraan->files()->create(['file' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Kemitraan berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $kemitraan = Kemitraan::with('files')->findOrFail($request->id);
                foreach ($kemitraan->files as $file) {
                    Storage::disk('public')->delete($file->file);
                }
                $kemitraan->delete();
                return response()->json(['status' => true, 'message' => 'Kemitraan berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
