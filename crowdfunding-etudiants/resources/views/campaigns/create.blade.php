@extends('layouts.app')

@section('title', 'Creer une campagne - FundCampus')

@section('content')
    <section class="container">
        <div class="page-head">
            <div>
                <p class="eyebrow">Nouvelle campagne</p>
                <h1>Creer une campagne</h1>
            </div>
        </div>

        @if ($students->isEmpty())
            <div class="notice">Ajoutez d'abord un etudiant responsable avant de creer une campagne.</div>
            <x-button :href="route('students.create')">Ajouter un etudiant</x-button>
        @else
            <form class="card" method="POST" action="{{ route('campaigns.store') }}">
                @include('campaigns._form', ['campaign' => null, 'submitLabel' => 'Enregistrer'])
            </form>
        @endif
    </section>
@endsection
