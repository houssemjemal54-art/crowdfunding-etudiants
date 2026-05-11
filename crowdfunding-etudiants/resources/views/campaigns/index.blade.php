@extends('layouts.app')

@section('title', 'Campagnes - FundCampus')

@section('content')
    <section class="container">
        <div class="page-head">
            <div>
                <p class="eyebrow">CRUD campagnes</p>
                <h1>Campagnes de financement</h1>
            </div>
            <x-button :href="route('campaigns.create')">Creer</x-button>
        </div>

        <form class="toolbar" method="GET" action="{{ route('campaigns.index') }}">
            <input class="search-input" name="search" value="{{ $search }}" placeholder="Rechercher une campagne">
            <select class="form-control" name="status" style="max-width:180px;">
                <option value="">Tous les statuts</option>
                @foreach (['draft' => 'Brouillon', 'active' => 'Active', 'funded' => 'Financee', 'closed' => 'Cloturee'] as $value => $label)
                    <option value="{{ $value }}" @selected($status === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <x-button type="submit" variant="secondary">Filtrer</x-button>
        </form>

        <div class="grid grid-3">
            @forelse ($campaigns as $campaign)
                @include('partials.campaign-card', ['campaign' => $campaign])
            @empty
                <div class="card">
                    <h3>Aucune campagne trouvee</h3>
                    <p class="muted">Creez une campagne apres avoir ajoute un etudiant.</p>
                </div>
            @endforelse
        </div>

        <div class="pagination">{{ $campaigns->links() }}</div>
    </section>
@endsection
