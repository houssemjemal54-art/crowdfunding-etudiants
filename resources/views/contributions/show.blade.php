@extends('layouts.app')

@section('title', 'Contribution - FundCampus')

@section('content')
    <section class="container">
        <div class="page-head">
            <div>
                <p class="eyebrow">Detail contribution</p>
                <h1>{{ number_format($contribution->amount, 2, ',', ' ') }} DT</h1>
                <p class="lead">Campagne : <a href="{{ route('campaigns.show', $contribution->campaign) }}">{{ $contribution->campaign->title }}</a></p>
            </div>
            <div class="actions" style="margin-top:0;">
                <x-button :href="route('contributions.edit', $contribution)" variant="secondary">Modifier</x-button>
                <form method="POST" action="{{ route('contributions.destroy', $contribution) }}" onsubmit="return confirm('Supprimer cette contribution ?')">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger">Supprimer</x-button>
                </form>
            </div>
        </div>

        <div class="grid grid-2">
            <div class="card">
                <h3>Donateur</h3>
                <p><strong>Nom :</strong> {{ $contribution->anonymous ? 'Anonyme' : $contribution->donor_name }}</p>
                <p><strong>Email :</strong> {{ $contribution->donor_email ?: 'Non renseigne' }}</p>
                <p><strong>Etudiant rattache :</strong> {{ $contribution->student->name ?? 'Aucun' }}</p>
            </div>
            <div class="card">
                <h3>Message</h3>
                <p>{{ $contribution->message ?: 'Aucun message.' }}</p>
                <p class="muted">Date paiement : {{ optional($contribution->paid_at)->format('d/m/Y') ?: 'Non renseignee' }}</p>
            </div>
        </div>
    </section>
@endsection
