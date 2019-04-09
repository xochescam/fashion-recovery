@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <h2 class="text-center mb-5">Closets</h2>

        @include('alerts.success')
        @include('alerts.warning')

        <a href="{{ url('closet') }}" class="btn btn-fr mb-4">Crear closet</a>

        <div class="row">

          @foreach($closets as $closet)

            <div class="col-sm-4 mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"> {{ $closet->ClosetName }} </h5>
                  <a href="{{ route('closet.show',$closet->ClosetID) }}" class="btn btn-fr">Ver</a>
                  <a href="{{ route('closet.edit',$closet->ClosetID) }}" class="btn btn-fr">Administrar</a>
                  <a href="{{ route('closet.destroy',$closet->ClosetID) }}" class="btn btn-danger">Eliminar</a>
                </div>
              </div>
            </div>

          @endforeach

        </div>

      </div>
    </main>

@endsection
