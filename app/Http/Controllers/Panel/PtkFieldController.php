<?php

namespace App\Http\Controllers\Panel;

use App\Models\PtkField;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Ptk\PtkFieldRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PtkFieldController extends Controller
{
    public function list()
    {
        return view('contents.ptk-field.list', [
            'title'      => 'Struktur Field Data PTK',
            'activeSlug' => 'ptk',
        ]);
    }

    public function datatable()
    {
        $data = PtkField::orderBy('sort_order')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('type_label', fn ($row) => match ($row->type) {
                'text'   => 'Teks',
                'number' => 'Angka',
                'select' => 'Pilihan',
                'date'   => 'Tanggal',
                default  => $row->type,
            })
            ->addColumn('options_preview', fn ($row) => $row->options ? implode(', ', $row->options) : '-')
            ->addColumn('filter_badge', fn ($row) => $row->is_filterable
                ? '<span class="badge bg-info">Bisa untuk Rekap</span>'
                : '<span class="text-muted">-</span>')
            ->addColumn('action', function ($row) {
                $optionsAttr = $row->options ? e(implode("\n", $row->options)) : '';
                $btn  = '<div class="btn-group">';
                $btn .= '<button class="btn btn-primary btn-sm btn-edit" data-id="' . $row->id . '" data-label="' . e($row->label) . '" data-type="' . $row->type . '" data-options="' . $optionsAttr . '" data-required="' . (int) $row->is_required . '" data-filterable="' . (int) $row->is_filterable . '" title="Edit"><i class="icofont icofont-ui-edit"></i></button>';
                $btn .= '<button class="btn btn-danger btn-sm btn-delete" data-id="' . $row->id . '" title="Hapus"><i class="icofont icofont-trash"></i></button>';
                $btn .= '</div>';
                return $btn;
            })
            ->rawColumns(['filter_badge', 'action'])
            ->make(true);
    }

    public function store(PtkFieldRequest $request)
    {
        $validated = $request->validated();

        PtkField::create([
            'label'         => $validated['label'],
            'type'          => $validated['type'],
            'options'       => $validated['type'] === 'select'
                ? array_values(array_filter(array_map('trim', explode("\n", $validated['options']))))
                : null,
            'is_required'   => $request->boolean('is_required'),
            'is_filterable' => $request->boolean('is_filterable'),
            'sort_order'    => PtkField::max('sort_order') + 1,
        ]);

        return response()->json(['message' => 'Field berhasil ditambahkan!']);
    }

    public function update(PtkFieldRequest $request)
    {
        $validated = $request->validated();
        $field = PtkField::findOrFail($validated['id']);

        $field->update([
            'label'         => $validated['label'],
            'type'          => $validated['type'],
            'options'       => $validated['type'] === 'select'
                ? array_values(array_filter(array_map('trim', explode("\n", $validated['options']))))
                : null,
            'is_required'   => $request->boolean('is_required'),
            'is_filterable' => $request->boolean('is_filterable'),
        ]);

        return response()->json(['message' => 'Field berhasil diperbarui!']);
    }

    public function delete(Request $request)
    {
        PtkField::findOrFail($request->id)->delete();
        return response()->json(['message' => 'Field berhasil dihapus! Data lama pada field ini tidak otomatis terhapus dari record yang sudah ada.']);
    }
}