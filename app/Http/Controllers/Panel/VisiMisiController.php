<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\VisiMisi\VisiMisiStoreRequest;
use App\Http\Requests\Panel\VisiMisi\VisiMisiUpdateRequest;
use App\Models\VisiMisi;
use App\Models\VisiMisiImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class VisiMisiController extends Controller
{
    public function list()
    {
        return view('contents.visi_misi.list', [
            'title' => 'Daftar Visi Misi',
            'plugins' => ['datatable']
        ]);
    }

    public function show() {
        $visiMisi = VisiMisi::with('images')->get();

        return view('front.profil.visi_misi', compact('visiMisi'));
    }

    public function datatable()
    {
        return DataTables::of(VisiMisi::query())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(VisiMisiStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $visiMisi = VisiMisi::create($request->only(['title', 'description']));

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('visi_misis', 'public');
                        $visiMisi->images()->create(['image' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Visi Misi berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $visiMisi = VisiMisi::with('images')->findOrFail($id);
            return response()->json(['status' => true, 'data' => $visiMisi], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(VisiMisiUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $visiMisi = VisiMisi::findOrFail($request->id);
                $visiMisi->update($request->only(['title', 'description']));

                if ($request->filled('deleted_images')) {
                    foreach ($request->deleted_images as $imageId) {
                        $image = VisiMisiImage::find($imageId);
                        if ($image) {
                            Storage::disk('public')->delete($image->image);
                            $image->delete();
                        }
                    }
                }

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('visi_misis', 'public');
                        $visiMisi->images()->create(['image' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Visi Misi berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $visiMisi = VisiMisi::with('images')->findOrFail($request->id);
                foreach ($visiMisi->images as $image) {
                    Storage::disk('public')->delete($image->image);
                }
                $visiMisi->delete();
                return response()->json(['status' => true, 'message' => 'Visi Misi berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
