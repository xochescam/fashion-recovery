@extends('layout.master')
@section('title', 'Resultados de la búsqueda')

@section('content')

  <main id="main">

    <div class="row justify-content-start p-3 mx-0 mx-md-5">
      <h2 class="text-left TituloFR my-4 mb-5">Resultados de la búsqueda</h2>
    </div>

		<section>
		  	<div class="container-fluid" id="app">
          @include('search.results')
		  	</div>
		</section>
  </main>

@endsection