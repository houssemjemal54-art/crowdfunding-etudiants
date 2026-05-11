@php
    $collected = $campaign->contributions_sum_amount ?? $campaign->collected_amount;
    $progress = (float) $campaign->goal_amount > 0 ? min(100, (int) round(((float) $collected / (float) $campaign->goal_amount) * 100)) : 0;
@endphp

<article class="card">
    @if ($campaign->image_url)
        <img src="{{ $campaign->image_url }}" alt="{{ $campaign->title }}" style="height:150px;width:100%;object-fit:cover;border-radius:6px;margin-bottom:14px;">
    @endif
    <div style="display:flex;justify-content:space-between;gap:10px;align-items:flex-start;">
        <h3>{{ $campaign->title }}</h3>
        <x-status-badge :status="$campaign->status" />
    </div>
    <p class="muted">{{ $campaign->category }} - {{ $campaign->student->name ?? 'Etudiant inconnu' }}</p>
    <div class="progress" aria-label="Progression">
        <span style="width: {{ $progress }}%"></span>
    </div>
    <p class="muted">{{ number_format($collected, 0, ',', ' ') }} DT / {{ number_format($campaign->goal_amount, 0, ',', ' ') }} DT</p>
    <div class="actions">
        <x-button :href="route('campaigns.show', $campaign)" variant="secondary">Voir detail</x-button>
    </div>
</article>
