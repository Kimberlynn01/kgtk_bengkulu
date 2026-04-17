<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\HasilSurvey\HasilSurveyStoreRequest;
use App\Http\Requests\Panel\HasilSurvey\HasilSurveyUpdateRequest;
use App\Models\HasilSurvey;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class HasilSurveyController extends Controller
{
    public function list()
    {
        return view('contents.hasil_survey.list', [
            'title' => 'Daftar Hasil Survey',
            'plugins' => ['datatable']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(HasilSurvey::query())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '';
            })
            ->make(true);
    }

    public function store(HasilSurveyStoreRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                if ($request->hasFile('image')) {
                    $data['image'] = $request->file('image')->store('hasil_surveys', 'public');
                }
                HasilSurvey::create($data);
            });
            return response()->json(['status' => true, 'message' => 'Hasil Survey berhasil disimpan'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $hasilSurvey = HasilSurvey::findOrFail($id);
            return response()->json(['status' => true, 'data' => $hasilSurvey], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(HasilSurveyUpdateRequest $request)
    {
        try {
            $hasilSurvey = HasilSurvey::findOrFail($request->id);
            DB::transaction(function () use ($hasilSurvey, $request) {
                $data = $request->validated();
                if ($request->hasFile('image')) {
                    if ($hasilSurvey->image) {
                        Storage::disk('public')->delete($hasilSurvey->image);
                    }
                    $data['image'] = $request->file('image')->store('hasil_surveys', 'public');
                }
                $hasilSurvey->update($data);
            });
            return response()->json(['status' => true, 'message' => 'Hasil Survey berhasil diupdate'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $hasilSurvey = HasilSurvey::findOrFail($request->id);
            DB::transaction(function () use ($hasilSurvey) {
                if ($hasilSurvey->image) {
                    Storage::disk('public')->delete($hasilSurvey->image);
                }
                $hasilSurvey->delete();
            });
            return response()->json(['status' => true, 'message' => 'Hasil Survey berhasil dihapus'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
