@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
        <h2 class="text-center TituloFR my-4 mb-5 ">Mis favoritos</h2>

        <p class="mb-5 text-center w-100">Encuentra las prendas que más te gustaron y que has marcado como favoritas, pero apresúrate, alguien te las puede ganar. </p>

        <div class="row" id="app">

            @include('item.partials.card') 

        </div>

    </div>
	</main>
@endsection
