<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Artikel\ArtikelStoreRequest;
use App\Http\Requests\Panel\Artikel\ArtikelUpdateRequest;
use App\Models\Artikel;
use App\Models\ArtikelImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArtikelController extends Controller
{
    public function list()
    {
        return view('contents.artikel.list', [
            'title' => 'Daftar Artikel',
            'plugins' => ['datatable', 'ckeditor']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(Artikel::query()->latest('date'))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return ''; // Will be handled by JS
            })
            ->make(true);
    }

    public function store(ArtikelStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $artikel = Artikel::create([
                    'date' => now(),
                    'title' => $request->title,
                    'content' => $request->content,
                ]);

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('artikels', 'public');
                        $artikel->images()->create(['image' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Artikel berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $artikel = Artikel::with('images')->findOrFail($id);
            return response()->json(['status' => true, 'data' => $artikel], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(ArtikelUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $artikel = Artikel::findOrFail($request->id);
                $artikel->update([
                    'title' => $request->title,
                    'content' => $request->content,
                ]);

                if ($request->filled('deleted_images')) {
                    foreach ($request->deleted_images as $imageId) {
                        $image = ArtikelImage::find($imageId);
                        if ($image) {
                            Storage::disk('public')->delete($image->image);
                            $image->delete();
                        }
                    }
                }

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('artikels', 'public');
                        $artikel->images()->create(['image' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Artikel berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $artikel = Artikel::with('images')->findOrFail($request->id);
                foreach ($artikel->images as $image) {
                    Storage::disk('public')->delete($image->image);
                }
                $artikel->delete();
                return response()->json(['status' => true, 'message' => 'Artikel berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
