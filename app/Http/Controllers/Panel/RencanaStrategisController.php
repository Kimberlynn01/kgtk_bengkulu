<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\RencanaStrategis\RencanaStrategisStoreRequest;
use App\Http\Requests\Panel\RencanaStrategis\RencanaStrategisUpdateRequest;
use App\Models\RencanaStrategis;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class RencanaStrategisController extends Controller
{
    public function list()
    {
        return view('contents.rencana_strategis.list', [
            'title' => 'Daftar Rencana Strategis',
            'plugins' => ['datatable']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(RencanaStrategis::query())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(RencanaStrategisStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = $request->only(['title', 'description']);

                if ($request->hasFile('pdf')) {
                    $data['pdf'] = $request->file('pdf')->store('rencana_strategis', 'public');
                }

                RencanaStrategis::create($data);

                return response()->json(['status' => true, 'message' => 'Rencana Strategis berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $rencana_strategis = RencanaStrategis::findOrFail($id);
            return response()->json(['status' => true, 'data' => $rencana_strategis], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(RencanaStrategisUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $rencana_strategis = RencanaStrategis::findOrFail($request->id);
                $data = $request->only(['title', 'description']);

                if ($request->hasFile('pdf')) {
                    if ($rencana_strategis->pdf) {
                        Storage::disk('public')->delete($rencana_strategis->pdf);
                    }
                    $data['pdf'] = $request->file('pdf')->store('rencana_strategis', 'public');
                }

                $rencana_strategis->update($data);

                return response()->json(['status' => true, 'message' => 'Rencana Strategis berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $rencana_strategis = RencanaStrategis::findOrFail($request->id);

                if ($rencana_strategis->pdf) {
                    Storage::disk('public')->delete($rencana_strategis->pdf);
                }

                $rencana_strategis->delete();

                return response()->json(['status' => true, 'message' => 'Rencana Strategis berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
