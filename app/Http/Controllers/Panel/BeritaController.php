<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Berita\BeritaStoreRequest;
use App\Http\Requests\Panel\Berita\BeritaUpdateRequest;
use App\Models\Berita;
use App\Models\BeritaImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function list()
    {
        return view('contents.berita.list', [
            'title' => 'Daftar Berita',
            'plugins' => ['datatable', 'ckeditor']
        ]);
    }

    public function show()
    {
        $beritas = Berita::with('images')->latest()->paginate(9);

        return view('front.publikasi.berita.list', compact('beritas'));
    }

    public function showBySlug($slug)
    {
        try {
            $berita = Berita::with('images')
                ->where('slug', $slug)
                ->firstOrFail();

            return view('front.publikasi.berita.show', [
                'title' => $berita->title,
                'berita' => $berita
            ]);
        } catch (Exception $e) {
            abort(404, 'Berita tidak ditemukan.');
        }
    }

    public function datatable()
    {
        return DataTables::of(Berita::query()->latest('date'))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(BeritaStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $berita = Berita::create([
                    'date' => now(),
                    'title' => $request->title,
                    'content' => $request->content,
                ]);

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('beritas', 'public');
                        $berita->images()->create(['image' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Berita berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $berita = Berita::with('images')->findOrFail($id);
            return response()->json(['status' => true, 'data' => $berita], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(BeritaUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $berita = Berita::findOrFail($request->id);
                $berita->update([
                    'title' => $request->title,
                    'content' => $request->content,
                ]);

                if ($request->filled('deleted_images')) {
                    foreach ($request->deleted_images as $imageId) {
                        $image = BeritaImage::find($imageId);
                        if ($image) {
                            Storage::disk('public')->delete($image->image);
                            $image->delete();
                        }
                    }
                }

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('beritas', 'public');
                        $berita->images()->create(['image' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Berita berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $berita = Berita::with('images')->findOrFail($request->id);
                foreach ($berita->images as $image) {
                    Storage::disk('public')->delete($image->image);
                }
                $berita->delete();
                return response()->json(['status' => true, 'message' => 'Berita berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
