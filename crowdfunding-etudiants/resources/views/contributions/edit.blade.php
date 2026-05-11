@extends('layouts.app')

@section('title', 'Modifier une contribution - FundCampus')

@section('content')
    <section class="container">
        <div class="page-head">
            <div>
                <p class="eyebrow">Edition contribution</p>
                <h1>Modifier une contribution</h1>
            </div>
        </div>

        <form class="card" method="POST" action="{{ route('contributions.update', $contribution) }}">
            @method('PUT')
            @include('contributions._form', ['selectedCampaign' => null, 'submitLabel' => 'Mettre a jour'])
        </form>
    </section>
@endsection
