@extends('layouts.app')

@section('title', 'FundCampus - Crowdfunding etudiant')

@section('content')
    <section class="hero">
        <div class="container">
            <p class="eyebrow">Plateforme de crowdfunding etudiant</p>
            <h1>FundCampus finance les projets academiques et associatifs des etudiants.</h1>
            <p class="lead">Les porteurs de projets publient leurs campagnes, les contributeurs suivent l'avancement et chaque participation est enregistree avec transparence.</p>
            <div class="hero-actions">
                <x-button :href="route('campaigns.index')">Voir les campagnes</x-button>
                <x-button :href="route('campaigns.create')" variant="secondary">Creer une campagne</x-button>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="grid grid-3">
            <div class="card">
                <div class="stat">{{ $studentsCount }}</div>
                <div class="muted">Etudiants inscrits</div>
            </div>
            <div class="card">
                <div class="stat">{{ $campaignsCount }}</div>
                <div class="muted">Campagnes publiees</div>
            </div>
            <div class="card">
                <div class="stat">{{ number_format($contributionsTotal, 0, ',', ' ') }} DT</div>
                <div class="muted">Collectes enregistrees</div>
            </div>
        </div>
    </section>

    <section class="container" style="margin-top:32px;">
        <div class="page-head">
            <div>
                <p class="eyebrow">A la une</p>
                <h2>Dernieres campagnes</h2>
            </div>
            <x-button :href="route('campaigns.index')" variant="secondary">Tout afficher</x-button>
        </div>

        <div class="grid grid-3">
            @forelse ($featuredCampaigns as $campaign)
                @include('partials.campaign-card', ['campaign' => $campaign])
            @empty
                <div class="card">
                    <h3>Aucune campagne pour le moment</h3>
                    <p class="muted">Ajoutez un etudiant puis creez la premiere campagne.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
