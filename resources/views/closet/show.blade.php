@extends('dashboard.master')

@section('content')

	 <main >
      <div class="container py-5">
        <h2 class="text-center TituloFR my-4">{{ $closet->ClosetName }}</h2>
        <div class="edit-closet text-center">
          <small class="text-left align-middle text-black-50"> {{ isset($items) ? count($items) : '0' }} prenda{{ isset($items) && count($items) > 1 ? 's': '' }}</small>
<!--            <a class="card-link float-right" href="#" data-toggle="modal" data-target="#updateCollection"><i class="fas fa-pencil-alt"></i></a>
 -->        </div>

        <p class="mb-5 mt-5 text-center">{{ $closet->ClosetDescription }}</p>

        @include('alerts.success')
        @include('alerts.warning')

        <div class="row justify-content-start p-3" id="app">
          @include('item.partials.card-auth')        
        </div>

      </div>
    </main>

    @include('closet.edit')

@endsection
