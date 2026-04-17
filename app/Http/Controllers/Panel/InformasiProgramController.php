<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\InformasiProgram\InformasiProgramStoreRequest;
use App\Http\Requests\Panel\InformasiProgram\InformasiProgramUpdateRequest;
use App\Models\InformasiProgram;
use App\Models\InformasiProgramFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class InformasiProgramController extends Controller
{
    public function list()
    {
        return view('contents.informasi_program.list', [
            'title' => 'Daftar Informasi & Program',
            'plugins' => ['datatable']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(InformasiProgram::query())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(InformasiProgramStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $informasiProgram = InformasiProgram::create($request->only(['title']));

                if ($request->hasFile('files')) {
                    foreach ($request->file('files') as $file) {
                        $path = $file->store('informasi_programs', 'public');
                        $informasiProgram->files()->create(['file' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Informasi & Program berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $informasiProgram = InformasiProgram::with('files')->findOrFail($id);
            return response()->json(['status' => true, 'data' => $informasiProgram], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(InformasiProgramUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $informasiProgram = InformasiProgram::findOrFail($request->id);
                $informasiProgram->update($request->only(['title']));

                if ($request->filled('deleted_files')) {
                    foreach ($request->deleted_files as $fileId) {
                        $file = InformasiProgramFile::find($fileId);
                        if ($file) {
                            Storage::disk('public')->delete($file->file);
                            $file->delete();
                        }
                    }
                }

                if ($request->hasFile('files')) {
                    foreach ($request->file('files') as $file) {
                        $path = $file->store('informasi_programs', 'public');
                        $informasiProgram->files()->create(['file' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Informasi & Program berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $informasiProgram = InformasiProgram::with('files')->findOrFail($request->id);
                foreach ($informasiProgram->files as $file) {
                    Storage::disk('public')->delete($file->file);
                }
                $informasiProgram->delete();
                return response()->json(['status' => true, 'message' => 'Informasi & Program berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
