@extends('layouts.app')

@section('title', 'A propos - FundCampus')

@section('content')
    <section class="container">
        <div class="page-head">
            <div>
                <p class="eyebrow">A propos</p>
                <h1>Une application Laravel orientee MVC.</h1>
                <p class="lead">FundCampus repond au cahier des charges avec plusieurs entites reliees, des CRUD complets, des formulaires valides cote serveur, des vues Blade composees, la recherche et la pagination.</p>
            </div>
        </div>

        <div class="grid grid-3">
            <div class="card">
                <h3>Etudiants</h3>
                <p class="muted">Gestion des porteurs de projets, de leur formation et de leur universite.</p>
            </div>
            <div class="card">
                <h3>Campagnes</h3>
                <p class="muted">Creation et suivi des objectifs de financement avec statut, date limite et categorie.</p>
            </div>
            <div class="card">
                <h3>Contributions</h3>
                <p class="muted">Enregistrement des dons, messages, contributeurs anonymes et rattachement aux campagnes.</p>
            </div>
        </div>
    </section>
@endsection
