@extends('layouts.app')

@section('title', 'Contact - FundCampus')

@section('content')
    <section class="container">
        <div class="page-head">
            <div>
                <p class="eyebrow">Contact</p>
                <h1>Equipe projet FundCampus</h1>
                <p class="lead">Cette page statique complete les livrables demandes et centralise les informations de presentation du groupe.</p>
            </div>
        </div>

        <div class="grid grid-2">
            <div class="card">
                <h3>Coordonnees</h3>
                <p class="muted">Email : equipe@fundcampus.test</p>
                <p class="muted">Classe : 2-LBC</p>
                <p class="muted">Sujet : plateforme de crowdfunding d'etudiants</p>
            </div>
            <div class="card">
                <h3>Repartition GitHub</h3>
                <p class="muted">Chaque membre du groupe dispose d'un CRUD complet a presenter et d'une zone de commits dediee dans le README.</p>
            </div>
        </div>
    </section>
@endsection
