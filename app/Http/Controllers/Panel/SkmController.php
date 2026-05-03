<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Skm\SkmStoreRequest;
use App\Http\Requests\Panel\Skm\SkmUpdateRequest;
use App\Models\Skm;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SkmController extends Controller
{
    public function list()
    {
        return view('contents.skm.list', [
            'title' => 'Daftar Survey Kepuasan Masyarakat',
            'plugins' => ['datatable']
        ]);
    }

    public function show()
    {
        $skm = Skm::latest()->first();

        return view('front.publikasi.skm', compact('skm'));
    }

    public function datatable()
    {
        return DataTables::of(Skm::query())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(SkmStoreRequest $request)
    {
        try {
            DB::transaction(fn() => Skm::create($request->validated()));
            return response()->json(['status' => true, 'message' => 'Skm berhasil disimpan'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $skm = Skm::findOrFail($id);
            return response()->json(['status' => true, 'data' => $skm], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(SkmUpdateRequest $request)
    {
        try {
            $skm = Skm::findOrFail($request->id);
            DB::transaction(fn() => $skm->update($request->validated()));
            return response()->json(['status' => true, 'message' => 'Skm berhasil diupdate'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $skm = Skm::findOrFail($request->id);
            DB::transaction(fn() => $skm->delete());
            return response()->json(['status' => true, 'message' => 'Skm berhasil dihapus'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
