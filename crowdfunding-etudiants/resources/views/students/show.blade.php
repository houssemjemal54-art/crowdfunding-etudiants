@extends('layouts.app')

@section('title', $student->name.' - FundCampus')

@section('content')
    <section class="container">
        <div class="page-head">
            <div>
                <p class="eyebrow">Profil etudiant</p>
                <h1>{{ $student->name }}</h1>
                <p class="lead">{{ $student->major }} - {{ $student->university }}</p>
            </div>
            <div class="actions" style="margin-top:0;">
                <x-button :href="route('students.edit', $student)" variant="secondary">Modifier</x-button>
                <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('Supprimer cet etudiant ?')">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger">Supprimer</x-button>
                </form>
            </div>
        </div>

        <div class="grid grid-2">
            <div class="card">
                <h3>Informations</h3>
                <p><strong>Email :</strong> {{ $student->email }}</p>
                <p><strong>Bio :</strong> {{ $student->bio ?: 'Non renseignee' }}</p>
            </div>
            <div class="card">
                <h3>Activite</h3>
                <p class="muted">{{ $student->campaigns->count() }} campagne(s) creee(s)</p>
                <p class="muted">{{ $student->contributions->count() }} contribution(s) rattachee(s)</p>
            </div>
        </div>

        <div style="margin-top:28px;">
            <div class="page-head">
                <h2>Campagnes de l'etudiant</h2>
                <x-button :href="route('campaigns.create')" variant="secondary">Nouvelle campagne</x-button>
            </div>
            <div class="grid grid-3">
                @forelse ($student->campaigns as $campaign)
                    @include('partials.campaign-card', ['campaign' => $campaign])
                @empty
                    <div class="card"><p class="muted">Aucune campagne associee.</p></div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
