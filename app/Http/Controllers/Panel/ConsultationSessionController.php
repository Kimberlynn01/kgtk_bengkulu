<?php

namespace App\Http\Controllers\Panel;

use App\Models\ConsultationSession;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Consultation\ConsultationSessionStoreRequest;
use App\Http\Requests\Panel\Consultation\ConsultationSessionUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ConsultationSessionController extends Controller
{
    public function list()
    {
        return view('contents.consultation-session.list', [
            'title'      => 'Sesi Konsultasi (Gmeet)',
            'activeSlug' => 'qna',
        ]);
    }

    public function datatable()
    {
        $data = ConsultationSession::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('image_preview', function ($row) {
                return $row->image
                    ? '<img src="' . asset('storage/' . $row->image) . '" style="width:50px;height:50px;object-fit:cover;border-radius:6px;">'
                    : '<span class="text-muted small">-</span>';
            })
            ->addColumn('status', function ($row) {
                return $row->is_active
                    ? '<span class="badge bg-success">Aktif</span>'
                    : '<span class="badge bg-secondary">Nonaktif</span>';
            })
            ->addColumn('action', function ($row) {
                $btn  = '<div class="btn-group">';
                $btn .= '<button class="btn btn-primary btn-sm btn-edit" data-id="' . $row->id . '" data-title="' . e($row->title) . '" data-slug="' . e($row->slug) . '" data-description="' . e($row->description) . '" data-gmeet="' . e($row->gmeet_link) . '" data-image="' . ($row->image ? asset('storage/' . $row->image) : '') . '" data-active="' . (int) $row->is_active . '" title="Edit"><i class="icofont icofont-ui-edit"></i></button>';
                $btn .= '<button class="btn btn-danger btn-sm btn-delete" data-id="' . $row->id . '" title="Hapus"><i class="icofont icofont-trash"></i></button>';
                $btn .= '</div>';
                return $btn;
            })
            ->rawColumns(['image_preview', 'status', 'action'])
            ->make(true);
    }

    /**
     * Dipanggil dari front-end (JS panel) untuk cek apakah sudah ada 1 data,
     * dipakai untuk hide/show tombol "Tambah Sesi".
     */
    public function checkAvailability()
    {
        return response()->json([
            'exists' => ConsultationSession::exists(),
        ]);
    }

    public function store(ConsultationSessionStoreRequest $request)
    {
        // ── Pembatasan: maksimal 1 data, tidak boleh lebih ──────────
        if (ConsultationSession::exists()) {
            return response()->json([
                'message' => 'Sesi konsultasi sudah ada. Hanya boleh ada 1 sesi — silakan edit data yang sudah ada.',
            ], 422);
        }

        $validated = $request->validated();

        $data = [
            'title'       => $validated['title'],
            'slug'        => $validated['slug'] ?: Str::slug($validated['title']),
            'description' => $validated['description'],
            'gmeet_link'  => $validated['gmeet_link'],
            'is_active'   => true,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('consultation-sessions', 'public');
        }

        ConsultationSession::create($data);

        return response()->json(['message' => 'Sesi konsultasi berhasil ditambahkan!']);
    }

    public function update(ConsultationSessionUpdateRequest $request)
    {
        $validated = $request->validated();
        $session   = ConsultationSession::findOrFail($validated['id']);

        $data = [
            'title'       => $validated['title'],
            'slug'        => $validated['slug'] ?: Str::slug($validated['title']),
            'description' => $validated['description'],
            'gmeet_link'  => $validated['gmeet_link'],
            'is_active'   => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($session->image) {
                Storage::disk('public')->delete($session->image);
            }
            $data['image'] = $request->file('image')->store('consultation-sessions', 'public');
        }

        $session->update($data);

        return response()->json(['message' => 'Sesi konsultasi berhasil diperbarui!']);
    }

    public function delete(Request $request)
    {
        $session = ConsultationSession::findOrFail($request->id);

        if ($session->image) {
            Storage::disk('public')->delete($session->image);
        }

        $session->delete();

        return response()->json(['message' => 'Sesi konsultasi berhasil dihapus!']);
    }
}