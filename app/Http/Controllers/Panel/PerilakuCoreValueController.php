<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PerilakuCoreValue\PerilakuCoreValueStoreRequest;
use App\Http\Requests\Panel\PerilakuCoreValue\PerilakuCoreValueUpdateRequest;
use App\Models\PerilakuCoreValue;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PerilakuCoreValueController extends Controller
{
    public function list()
    {
        return view('contents.perilaku_core_value.list', [
            'title' => 'Daftar Perilaku & Core Value',
            'plugins' => ['datatable']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(PerilakuCoreValue::query())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(PerilakuCoreValueStoreRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = $request->only(['title', 'description']);

                if ($request->hasFile('pdf')) {
                    $data['pdf'] = $request->file('pdf')->store('perilaku_core_values', 'public');
                }

                PerilakuCoreValue::create($data);

                return response()->json(['status' => true, 'message' => 'Perilaku & Core Value berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $perilaku_core_value = PerilakuCoreValue::findOrFail($id);
            return response()->json(['status' => true, 'data' => $perilaku_core_value], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(PerilakuCoreValueUpdateRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $perilaku_core_value = PerilakuCoreValue::findOrFail($request->id);
                $data = $request->only(['title', 'description']);

                if ($request->hasFile('pdf')) {
                    if ($perilaku_core_value->pdf) {
                        Storage::disk('public')->delete($perilaku_core_value->pdf);
                    }
                    $data['pdf'] = $request->file('pdf')->store('perilaku_core_values', 'public');
                }

                $perilaku_core_value->update($data);

                return response()->json(['status' => true, 'message' => 'Perilaku & Core Value berhasil diupdate'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $perilaku_core_value = PerilakuCoreValue::findOrFail($request->id);

                if ($perilaku_core_value->pdf) {
                    Storage::disk('public')->delete($perilaku_core_value->pdf);
                }

                $perilaku_core_value->delete();

                return response()->json(['status' => true, 'message' => 'Perilaku & Core Value berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
