<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\TimKerja\TimKerjaStoreRequest;
use App\Http\Requests\Panel\TimKerja\TimKerjaUpdateRequest;
use App\Models\TimKerja;
use App\Models\TimKerjaImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TimKerjaController extends Controller
{
    public function list()
    {
        return view('contents.tim_kerja.list', [
            'title' => 'Daftar Tim Kerja',
            'plugins' => ['datatable']
        ]);
    }

    public function show()
    {
        $timKerja = TimKerja::with('images')->get();

        return view('front.profil.tim_kerja',compact('timKerja'));
    }

    public function datatable()
    {
        return DataTables::of(TimKerja::query())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(TimKerjaStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $timKerja = TimKerja::create($request->only(['title', 'description']));

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('tim_kerjas', 'public');
                        $timKerja->images()->create(['image' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Tim Kerja berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $timKerja = TimKerja::with('images')->findOrFail($id);
            return response()->json(['status' => true, 'data' => $timKerja], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(TimKerjaUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $timKerja = TimKerja::findOrFail($request->id);
                $timKerja->update($request->only(['title', 'description']));

                if ($request->filled('deleted_images')) {
                    foreach ($request->deleted_images as $imageId) {
                        $image = TimKerjaImage::find($imageId);
                        if ($image) {
                            Storage::disk('public')->delete($image->image);
                            $image->delete();
                        }
                    }
                }

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('tim_kerjas', 'public');
                        $timKerja->images()->create(['image' => $path]);
                    }
                }

                return response()->json(['status' => true, 'message' => 'Tim Kerja berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $timKerja = TimKerja::with('images')->findOrFail($request->id);
                foreach ($timKerja->images as $image) {
                    Storage::disk('public')->delete($image->image);
                }
                $timKerja->delete();
                return response()->json(['status' => true, 'message' => 'Tim Kerja berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
