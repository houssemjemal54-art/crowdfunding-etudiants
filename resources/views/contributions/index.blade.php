@extends('layouts.app')

@section('title', 'Contributions - FundCampus')

@section('content')
    <section class="container">
        <div class="page-head">
            <div>
                <p class="eyebrow">CRUD contributions</p>
                <h1>Contributions aux campagnes</h1>
            </div>
            <x-button :href="route('contributions.create')">Ajouter</x-button>
        </div>

        <form class="toolbar" method="GET" action="{{ route('contributions.index') }}">
            <input class="search-input" name="search" value="{{ $search }}" placeholder="Rechercher une contribution">
            <x-button type="submit" variant="secondary">Rechercher</x-button>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Campagne</th>
                        <th>Donateur</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contributions as $contribution)
                        <tr>
                            <td><a href="{{ route('campaigns.show', $contribution->campaign) }}">{{ $contribution->campaign->title }}</a></td>
                            <td>{{ $contribution->anonymous ? 'Anonyme' : $contribution->donor_name }}</td>
                            <td>{{ number_format($contribution->amount, 2, ',', ' ') }} DT</td>
                            <td>{{ optional($contribution->paid_at)->format('d/m/Y') ?: $contribution->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="actions" style="margin-top:0;">
                                    <x-button :href="route('contributions.show', $contribution)" variant="secondary">Detail</x-button>
                                    <x-button :href="route('contributions.edit', $contribution)" variant="secondary">Modifier</x-button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">Aucune contribution trouvee.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">{{ $contributions->links() }}</div>
    </section>
@endsection
