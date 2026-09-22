<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\InformasiBerkala\InformasiBerkalaStoreRequest;
use App\Http\Requests\Panel\InformasiBerkala\InformasiBerkalaUpdateRequest;
use App\Models\InformasiBerkala;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class InformasiBerkalaController extends Controller
{
    public function list()
    {
        return view('contents.informasi_berkala.list', [
            'title' => 'Informasi Berkala',
            'plugins' => ['datatable'],
        ]);
    }

    public function datatable()
    {
        return DataTables::of(InformasiBerkala::query()->latest())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(InformasiBerkalaStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $path = $request->file('file')->store('informasi_berkala', 'public');

                InformasiBerkala::create([
                    'nama_dokumen' => $request->nama_dokumen,
                    'tahun'        => $request->tahun,
                    'file'         => $path,
                ]);

                return response()->json(['status' => true, 'message' => 'Informasi berkala berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $data = InformasiBerkala::findOrFail($id);
            return response()->json(['status' => true, 'data' => $data], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(InformasiBerkalaUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = InformasiBerkala::findOrFail($request->id);

                $updateData = [
                    'nama_dokumen' => $request->nama_dokumen,
                    'tahun'        => $request->tahun,
                ];

                if ($request->hasFile('file')) {
                    if ($data->file) {
                        Storage::disk('public')->delete($data->file);
                    }
                    $updateData['file'] = $request->file('file')->store('informasi_berkala', 'public');
                }

                $data->update($updateData);

                return response()->json(['status' => true, 'message' => 'Informasi berkala berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = InformasiBerkala::findOrFail($request->id);

                if ($data->file) {
                    Storage::disk('public')->delete($data->file);
                }

                $data->delete();

                return response()->json(['status' => true, 'message' => 'Informasi berkala berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}