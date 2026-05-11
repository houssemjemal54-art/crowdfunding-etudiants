@extends('layouts.app')

@section('title', 'Etudiants - FundCampus')

@section('content')
    <section class="container">
        <div class="page-head">
            <div>
                <p class="eyebrow">CRUD etudiants</p>
                <h1>Etudiants porteurs de projets</h1>
            </div>
            <x-button :href="route('students.create')">Ajouter</x-button>
        </div>

        <form class="toolbar" method="GET" action="{{ route('students.index') }}">
            <input class="search-input" name="search" value="{{ $search }}" placeholder="Rechercher un etudiant">
            <x-button type="submit" variant="secondary">Rechercher</x-button>
        </form>

        <div class="grid grid-3">
            @forelse ($students as $student)
                <article class="card">
                    <h3>{{ $student->name }}</h3>
                    <p class="muted">{{ $student->major }} - {{ $student->university }}</p>
                    <p>{{ $student->email }}</p>
                    <span class="badge">{{ $student->campaigns_count }} campagne(s)</span>
                    <div class="actions">
                        <x-button :href="route('students.show', $student)" variant="secondary">Detail</x-button>
                        <x-button :href="route('students.edit', $student)" variant="secondary">Modifier</x-button>
                    </div>
                </article>
            @empty
                <div class="card">
                    <h3>Aucun etudiant trouve</h3>
                    <p class="muted">Ajoutez un premier porteur de projet.</p>
                </div>
            @endforelse
        </div>

        <div class="pagination">{{ $students->links() }}</div>
    </section>
@endsection
