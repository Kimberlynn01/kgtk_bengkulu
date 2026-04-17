<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\ProfilPejabat\ProfilPejabatStoreRequest;
use App\Http\Requests\Panel\ProfilPejabat\ProfilPejabatUpdateRequest;
use App\Models\ProfilPejabat;
use App\Models\ProfilPejabatImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProfilPejabatController extends Controller
{
    public function list()
    {
        return view('contents.profil_pejabat.list', [
            'title' => 'Daftar Profil Pejabat',
            'plugins' => ['datatable']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(ProfilPejabat::query())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(ProfilPejabatStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $profilPejabat = ProfilPejabat::create($request->only(['title']));

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('profil_pejabats', 'public');
                        $profilPejabat->images()->create(['image' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Profil Pejabat berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $profilPejabat = ProfilPejabat::with('images')->findOrFail($id);
            return response()->json(['status' => true, 'data' => $profilPejabat], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(ProfilPejabatUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $profilPejabat = ProfilPejabat::findOrFail($request->id);
                $profilPejabat->update($request->only(['title']));

                if ($request->filled('deleted_images')) {
                    foreach ($request->deleted_images as $imageId) {
                        $image = ProfilPejabatImage::find($imageId);
                        if ($image) {
                            Storage::disk('public')->delete($image->image);
                            $image->delete();
                        }
                    }
                }

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('profil_pejabats', 'public');
                        $profilPejabat->images()->create(['image' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Profil Pejabat berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $profilPejabat = ProfilPejabat::with('images')->findOrFail($request->id);
                foreach ($profilPejabat->images as $image) {
                    Storage::disk('public')->delete($image->image);
                }
                $profilPejabat->delete();
                return response()->json(['status' => true, 'message' => 'Profil Pejabat berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
