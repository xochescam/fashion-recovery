@extends('layout.master')
@section('title', 'Resultados de la búsqueda')

@section('content')

  <main id="main">
    <div class="container py-5">
      <div class="row">
        <div class="col-12">
          <h1 class="text-left TituloFR my-4">Resultados de la búsqueda</h1>
        </div>
        <div class="col-12 text-justify">
          @include('search.results')
        </div>
  </main>

@endsection