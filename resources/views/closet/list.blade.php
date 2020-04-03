@extends('dashboard.master')

@section('content')

	<main id="main">
    <div class="container py-5">
      <h2 class="text-center TituloFR my-4 mb-5 ">Mis colecciones</h2>

      <p class="mb-5 text-center w-100">Estas son las listas de prendas que tienes disponibles para nuestra comunidad. Agrega nuevas prendas a tus colecciones y crea looks para tus seguidores a través de nuevas colecciones.</p>

      <div class="text-right w-100">
        <a href="{{ url('closet') }}" class="btn btn-fr mb-4">Crea una nueva colección</a>
      </div>

      @include('alerts.success')
      @include('alerts.warning')

      <div class="row" >
          
        @foreach($closets as $closet)
          <div class="col-sm-4 mb-4">

            @if(isset($items[$closet->ClosetID]))

              @include('closet.card')

            @else

              <div class="card"> 
                <div id="carousel_{{ $closet->ClosetID }}" class="mb-3">
                  <div class="content-empty"></div>
                </div>

                <div class="card-body">
                  <h5 class="card-title mb-0"> {{ $closet->ClosetName }} </h5>
                
                  <div class="edit-closet">
                    <small class="text-left align-middle"> {{ isset($items[$closet->ClosetID]) ? count($items[$closet->ClosetID]) : '0' }} prenda{{ isset($items[$closet->ClosetID]) && count($items[$closet->ClosetID]) === 1  ? '': 's' }}</small>
                    <a class="card-link float-right" href="#" data-toggle="modal" data-target="#updateCollection-{{ $closet->ClosetID }}"><i class="fas fa-pencil-alt"></i></a>
                  </div>
                </div>
              </div>

            @endif

          </div>

          @include('closet.edit')

        @endforeach

        </div>
      </div>
    </main>

   

@endsection