@extends('dashboard.master')

@section('content')

	 <main id="main" style="height:85vh;">
      <div class="container py-5">
        <h2 class="text-center mb-5">{{ $closet->ClosetName }}</h2>

        <a href="{{ url('item') }}" class="btn btn-fr mb-4">Subir prenda</a>

        @include('alerts.success')
        @include('alerts.warning')

        <div class="row">

          @foreach($items as $item)

            <div class="col-sm-4 mb-4">
              <div class="card">
                <div class="card-body">
                   {{ $item->ActualPrice }}
                </div>
              </div>
            </div>

          @endforeach

        </div>

      </div>
    </main>

@endsection
