@extends('layouts.app')

@section('title', $campaign->title.' - FundCampus')

@section('content')
    @php
        $collected = $campaign->collected_amount;
        $remaining = max(0, (float) $campaign->goal_amount - $collected);
    @endphp

    <section class="container">
        <div class="page-head">
            <div>
                <p class="eyebrow">{{ $campaign->category }}</p>
                <h1>{{ $campaign->title }}</h1>
                <p class="lead">Porteur : <a href="{{ route('students.show', $campaign->student) }}">{{ $campaign->student->name }}</a></p>
            </div>
            <div class="actions" style="margin-top:0;">
                <x-button :href="route('campaigns.edit', $campaign)" variant="secondary">Modifier</x-button>
                <form method="POST" action="{{ route('campaigns.destroy', $campaign) }}" onsubmit="return confirm('Supprimer cette campagne ?')">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger">Supprimer</x-button>
                </form>
            </div>
        </div>

        <div class="grid grid-2">
            <article class="card">
                @if ($campaign->image_url)
                    <img src="{{ $campaign->image_url }}" alt="{{ $campaign->title }}" style="height:260px;width:100%;object-fit:cover;border-radius:6px;margin-bottom:16px;">
                @endif
                <x-status-badge :status="$campaign->status" />
                <p>{{ $campaign->description }}</p>
                <p class="muted">Date limite : {{ $campaign->deadline->format('d/m/Y') }}</p>
            </article>

            <aside class="card">
                <h3>Objectif de financement</h3>
                <div class="stat">{{ number_format($collected, 0, ',', ' ') }} DT</div>
                <p class="muted">sur {{ number_format($campaign->goal_amount, 0, ',', ' ') }} DT - reste {{ number_format($remaining, 0, ',', ' ') }} DT</p>
                <div class="progress"><span style="width: {{ $campaign->progress }}%"></span></div>
                <div class="actions">
                    <x-button :href="route('contributions.create', ['campaign_id' => $campaign->id])">Contribuer</x-button>
                </div>
            </aside>
        </div>

        <section style="margin-top:28px;">
            <div class="page-head">
                <h2>Contributions</h2>
                <x-button :href="route('contributions.index')" variant="secondary">Voir toutes</x-button>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Donateur</th>
                            <th>Montant</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($campaign->contributions as $contribution)
                            <tr>
                                <td>{{ $contribution->anonymous ? 'Anonyme' : $contribution->donor_name }}</td>
                                <td>{{ number_format($contribution->amount, 2, ',', ' ') }} DT</td>
                                <td>{{ $contribution->message ?: '-' }}</td>
                                <td>{{ optional($contribution->paid_at)->format('d/m/Y') ?: $contribution->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4">Aucune contribution enregistree.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </section>
@endsection
