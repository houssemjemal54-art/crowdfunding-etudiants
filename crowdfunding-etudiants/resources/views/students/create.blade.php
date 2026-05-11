@extends('layouts.app')

@section('title', 'Ajouter un etudiant - FundCampus')

@section('content')
    <section class="container">
        <div class="page-head">
            <div>
                <p class="eyebrow">Nouveau profil</p>
                <h1>Ajouter un etudiant</h1>
            </div>
        </div>

        <form class="card" method="POST" action="{{ route('students.store') }}">
            @include('students._form', ['student' => null, 'submitLabel' => 'Enregistrer'])
        </form>
    </section>
@endsection
