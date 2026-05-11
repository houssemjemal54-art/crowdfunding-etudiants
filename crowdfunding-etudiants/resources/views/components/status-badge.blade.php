@props(['status'])

@php
    $labels = [
        'draft' => 'Brouillon',
        'active' => 'Active',
        'funded' => 'Financee',
        'closed' => 'Cloturee',
    ];
@endphp

<span class="badge {{ $status }}">{{ $labels[$status] ?? $status }}</span>
