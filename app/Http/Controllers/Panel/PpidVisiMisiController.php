<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PPID\VisiMisi\PpidVisiMisiStoreRequest;
use App\Http\Requests\Panel\PPID\VisiMisi\PpidVisiMisiUpdateRequest;
use App\Models\PpidVisiMisi;
use App\Models\PpidVisiMisiImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PpidVisiMisiController extends Controller
{
    public function list()
    {
        return view('contents.ppid.visi_misi.list', [
            'title' => 'PPID - Visi dan Misi',
            'plugins' => ['datatable']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(PpidVisiMisi::query()->latest())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(PpidVisiMisiStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = PpidVisiMisi::create([
                    'title'       => $request->title,
                    'description' => $request->description,
                ]);

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('ppid/visi-misi', 'public');
                        $data->images()->create(['image' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Visi Misi PPID berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $data = PpidVisiMisi::with('images')->findOrFail($id);
            return response()->json(['status' => true, 'data' => $data], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(PpidVisiMisiUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = PpidVisiMisi::findOrFail($request->id);

                $data->update([
                    'title'       => $request->title,
                    'description' => $request->description,
                ]);

                if ($request->filled('deleted_images')) {
                    foreach ($request->deleted_images as $imageId) {
                        $image = PpidVisiMisiImage::find($imageId);
                        if ($image) {
                            Storage::disk('public')->delete($image->image);
                            $image->delete();
                        }
                    }
                }

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('ppid/visi-misi', 'public');
                        $data->images()->create(['image' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Visi Misi PPID berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = PpidVisiMisi::with('images')->findOrFail($request->id);

                foreach ($data->images as $image) {
                    Storage::disk('public')->delete($image->image);
                }

                $data->delete();
                return response()->json(['status' => true, 'message' => 'Visi Misi PPID berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}