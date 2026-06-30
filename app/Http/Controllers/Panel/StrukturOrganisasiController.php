<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\StrukturOrganisasi\StrukturOrganisasiStoreRequest;
use App\Http\Requests\Panel\StrukturOrganisasi\StrukturOrganisasiUpdateRequest;
use App\Models\StrukturOrganisasi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class StrukturOrganisasiController extends Controller
{
    public function list()
    {
        return view('contents.struktur_organisasi.list', [
            'title' => 'Daftar Struktur Organisasi',
            'plugins' => ['datatable'],
        ]);
    }

    public function datatable()
    {
        return DataTables::of(StrukturOrganisasi::query())
            ->addIndexColumn()
            ->addColumn('action', fn($row) => '')
            ->make(true);
    }

    public function store(StrukturOrganisasiStoreRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                if ($request->hasFile('image')) {
                    $data['image'] = $request->file('image')->store('struktur_organisasis', 'public');
                }
                StrukturOrganisasi::create($data);
            });
            return response()->json(['status' => true, 'message' => 'Struktur Organisasi berhasil disimpan'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $data = StrukturOrganisasi::findOrFail($id);
            return response()->json(['status' => true, 'data' => $data], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(StrukturOrganisasiUpdateRequest $request)
    {
        try {
            $item = StrukturOrganisasi::findOrFail($request->id);
            DB::transaction(function () use ($item, $request) {
                $data = $request->validated();
                if ($request->hasFile('image')) {
                    if ($item->image) {
                        Storage::disk('public')->delete($item->image);
                    }
                    $data['image'] = $request->file('image')->store('struktur_organisasis', 'public');
                }
                $item->update($data);
            });
            return response()->json(['status' => true, 'message' => 'Struktur Organisasi berhasil diupdate'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $item = StrukturOrganisasi::findOrFail($request->id);
            DB::transaction(function () use ($item) {
                if ($item->image) {
                    Storage::disk('public')->delete($item->image);
                }
                $item->delete();
            });
            return response()->json(['status' => true, 'message' => 'Struktur Organisasi berhasil dihapus'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
