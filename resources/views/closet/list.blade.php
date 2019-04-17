@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <h2 class="text-center TituloFR my-4 mb-5 ">Guardarropas</h2>

        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia eligendi sint, officiis fugit optio ullam quod eveniet, unde quibusdam nostrum.</p>

        @include('alerts.success')
        @include('alerts.warning')

        <div>
          <a href="{{ url('closet') }}" class="btn btn-fr mb-4">Crear guardarropa</a>
        </div>

        <div class="row">
          

          @foreach($closets as $closet)

            <div class="col-sm-4 mb-4">
              <a href="{{ route('closet.show',$closet->ClosetID) }}">
              <div class="card card--public card--item">
                <div id="carousel_{{ $closet->ClosetID }}" class="carousel slide mb-3">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img src="{{ url('img/offers/zapatillas.jpeg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="{{ url('img/offers/zapatillas.jpeg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="{{ url('img/offers/zapatillas.jpeg') }}" class="d-block w-100" alt="...">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carousel_{{ $closet->ClosetID }}" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carousel_{{ $closet->ClosetID }}" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                <div class="card-body">
                  <h5 class="card-title"> {{ $closet->ClosetName }} </h5>
                  <a href="{{ route('closet.edit',$closet->ClosetID) }}" class="card-link">Configurar</a>
                  <a href="{{ route('closet.destroy',$closet->ClosetID) }}" class="card-link text-danger">Eliminar</a>
                </div>
              </div>
            </div>
            </a>

          @endforeach

        </div>

      </div>
    </main>

@endsection
