<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\JanjiMaklumat\JanjiMaklumatStoreRequest;
use App\Http\Requests\Panel\JanjiMaklumat\JanjiMaklumatUpdateRequest;
use App\Models\JanjiMaklumat;
use App\Models\JanjiMaklumatImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class JanjiMaklumatController extends Controller
{
    public function list()
    {
        return view('contents.janji_maklumat.list', [
            'title' => 'Daftar Janji & Maklumat',
            'plugins' => ['datatable']
        ]);
    }

    public function show()
    {
        $janjiMaklumat = JanjiMaklumat::with('images')->get();

        return view('front.profil.janji_maklumat', compact('janjiMaklumat'));
    }

    public function datatable()
    {
        return DataTables::of(JanjiMaklumat::query())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(JanjiMaklumatStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $janjiMaklumat = JanjiMaklumat::create($request->only(['title']));

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('janji_maklumats', 'public');
                        $janjiMaklumat->images()->create(['image' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Janji & Maklumat berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $janjiMaklumat = JanjiMaklumat::with('images')->findOrFail($id);
            return response()->json(['status' => true, 'data' => $janjiMaklumat], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(JanjiMaklumatUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $janjiMaklumat = JanjiMaklumat::findOrFail($request->id);
                $janjiMaklumat->update($request->only(['title']));

                if ($request->filled('deleted_images')) {
                    foreach ($request->deleted_images as $imageId) {
                        $image = JanjiMaklumatImage::find($imageId);
                        if ($image) {
                            Storage::disk('public')->delete($image->image);
                            $image->delete();
                        }
                    }
                }

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('janji_maklumats', 'public');
                        $janjiMaklumat->images()->create(['image' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Janji & Maklumat berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $janjiMaklumat = JanjiMaklumat::with('images')->findOrFail($request->id);
                foreach ($janjiMaklumat->images as $image) {
                    Storage::disk('public')->delete($image->image);
                }
                $janjiMaklumat->delete();
                return response()->json(['status' => true, 'message' => 'Janji & Maklumat berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
