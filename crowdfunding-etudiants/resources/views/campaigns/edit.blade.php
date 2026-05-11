@extends('layouts.app')

@section('title', 'Modifier une campagne - FundCampus')

@section('content')
    <section class="container">
        <div class="page-head">
            <div>
                <p class="eyebrow">Edition campagne</p>
                <h1>Modifier {{ $campaign->title }}</h1>
            </div>
        </div>

        <form class="card" method="POST" action="{{ route('campaigns.update', $campaign) }}">
            @method('PUT')
            @include('campaigns._form', ['submitLabel' => 'Mettre a jour'])
        </form>
    </section>
@endsection
