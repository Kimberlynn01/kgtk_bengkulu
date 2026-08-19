<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Sejarah\SejarahStoreRequest;
use App\Http\Requests\Panel\Sejarah\SejarahUpdateRequest;
use App\Models\Sejarah;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SejarahController extends Controller
{
    public function list()
    {
        return view('contents.sejarah.list', [
            'title' => 'Daftar Sejarah',
            'plugins' => ['datatable']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(Sejarah::query())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(SejarahStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = $request->only(['title', 'description']);

                if ($request->hasFile('image')) {
                    $data['image'] = $request->file('image')->store('sejarahs', 'public');
                }

                Sejarah::create($data);

                return response()->json(['status' => true, 'message' => 'Sejarah berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $sejarah = Sejarah::findOrFail($id);
            return response()->json(['status' => true, 'data' => $sejarah], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(SejarahUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $sejarah = Sejarah::findOrFail($request->id);
                $data = $request->only(['title', 'description']);

                if ($request->hasFile('image')) {
                    if ($sejarah->image) {
                        Storage::disk('public')->delete($sejarah->image);
                    }
                    $data['image'] = $request->file('image')->store('sejarahs', 'public');
                }

                $sejarah->update($data);

                return response()->json(['status' => true, 'message' => 'Sejarah berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $sejarah = Sejarah::findOrFail($request->id);

                if ($sejarah->image) {
                    Storage::disk('public')->delete($sejarah->image);
                }

                $sejarah->delete();

                return response()->json(['status' => true, 'message' => 'Sejarah berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
