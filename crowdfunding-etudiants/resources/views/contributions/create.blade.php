@extends('layouts.app')

@section('title', 'Ajouter une contribution - FundCampus')

@section('content')
    <section class="container">
        <div class="page-head">
            <div>
                <p class="eyebrow">Nouvelle contribution</p>
                <h1>Ajouter une contribution</h1>
            </div>
        </div>

        @if ($campaigns->isEmpty())
            <div class="notice">Creez d'abord une campagne avant d'enregistrer une contribution.</div>
            <x-button :href="route('campaigns.create')">Creer une campagne</x-button>
        @else
            <form class="card" method="POST" action="{{ route('contributions.store') }}">
                @include('contributions._form', ['contribution' => null, 'submitLabel' => 'Enregistrer'])
            </form>
        @endif
    </section>
@endsection
