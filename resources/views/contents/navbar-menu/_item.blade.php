{{-- resources/views/contents/navbar-menu/_item.blade.php --}}
<li class="list-group-item" style="padding-left: {{ 16 + ($level * 28) }}px;">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            @if ($level > 0)
                <span class="text-muted me-1">└</span>
            @endif
            <strong>{{ $menu->name }}</strong>
            @if (!$menu->path)
                <span class="badge bg-secondary ms-1" title="Hanya grup, tidak bisa diklik">Grup</span>
            @endif
            @if (!$menu->is_active)
                <span class="badge bg-danger ms-1">Nonaktif</span>
            @endif
            <div class="text-muted small">{{ $menu->path ?? '(tidak ada link — grup dropdown)' }}</div>
        </div>
        <button type="button" class="btn btn-sm btn-primary btn-edit-navbar"
            data-id="{{ $menu->id }}"
            data-name="{{ $menu->name }}"
            data-active="{{ (int) $menu->is_active }}">
            <i class="icofont icofont-ui-edit"></i> Edit
        </button>
    </div>
</li>

@if ($menu->children->count())
    @foreach ($menu->children as $child)
        @include('contents.navbar-menu._item', ['menu' => $child, 'level' => $level + 1])
    @endforeach
@endif