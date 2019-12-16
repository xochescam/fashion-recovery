@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <h2 class="text-center TituloFR my-4 mb-5 ">{{ $wishlist->NameList }}</h2>

        @include('alerts.success')
        @include('alerts.warning')

        <div class="row">

          @foreach($items as $item)

           @include('item.partials.card') 

          @endforeach

        </div>

      </div>
    </main>

@endsection