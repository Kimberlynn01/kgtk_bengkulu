<?php

namespace App\Http\Controllers\Api;

use App\Models\Ptk;
use App\Models\PtkField;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PtkController extends Controller
{
    public function fields()
    {
        $fields = PtkField::where('is_filterable', true)
            ->orderBy('sort_order')
            ->get(['key', 'label', 'options']);

        return response()->json([
            'success' => true,
            'data'    => $fields,
        ]);
    }

    public function recap(Request $request)
    {
        $rowKey = $request->query('row_key', 'jenjang');
        $colKey = $request->query('col_key', 'jabatan');

        $cacheKey = "ptk_recap_api_{$rowKey}_{$colKey}";

        $result = Cache::remember($cacheKey, 3600, function () use ($rowKey, $colKey) {
            $rowField = PtkField::where('key', $rowKey)->first();
            $colField = PtkField::where('key', $colKey)->first();

            if (!$rowField || !$colField) {
                return null;
            }

            $rowOptions = $rowField->options ?? [];
            $colOptions = $colField->options ?? [];

            $matrix = [];
            foreach ($rowOptions as $r) {
                foreach ($colOptions as $c) {
                    $matrix[$r][$c] = 0;
                }
            }

            foreach (Ptk::all() as $rec) {
                $rVal = $rec->value($rowKey);
                $cVal = $rec->value($colKey);
                if ($rVal !== null && $cVal !== null && isset($matrix[$rVal][$cVal])) {
                    $matrix[$rVal][$cVal] += $rec->jumlah;
                }
            }

            $rows = [];
            $colTotals = array_fill_keys($colOptions, 0);
            $grandTotal = 0;

            foreach ($rowOptions as $r) {
                $rowTotal = 0;
                $breakdown = [];

                foreach ($colOptions as $c) {
                    $count = $matrix[$r][$c];
                    $breakdown[] = ['label' => $c, 'value' => $count];
                    $rowTotal += $count;
                    $colTotals[$c] += $count;
                }

                $rows[] = [
                    'label'     => $r,
                    'total'     => $rowTotal,
                    'breakdown' => $breakdown,
                ];

                $grandTotal += $rowTotal;
            }

            return [
                'row_label'   => $rowField->label,
                'col_label'   => $colField->label,
                'columns'     => $colOptions,
                'rows'        => $rows,
                'column_totals' => collect($colOptions)->map(fn ($c) => [
                    'label' => $c,
                    'value' => $colTotals[$c],
                ])->values(),
                'grand_total' => $grandTotal,
            ];
        });

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Field row_key atau col_key tidak ditemukan.',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'data'    => $result,
        ]);
    }
}