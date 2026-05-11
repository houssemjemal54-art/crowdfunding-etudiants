@extends('layouts.app')

@section('title', 'Modifier un etudiant - FundCampus')

@section('content')
    <section class="container">
        <div class="page-head">
            <div>
                <p class="eyebrow">Edition profil</p>
                <h1>Modifier {{ $student->name }}</h1>
            </div>
        </div>

        <form class="card" method="POST" action="{{ route('students.update', $student) }}">
            @method('PUT')
            @include('students._form', ['submitLabel' => 'Mettre a jour'])
        </form>
    </section>
@endsection
