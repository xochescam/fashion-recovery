@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <h2 class="text-center TituloFR my-4 mb-5 ">{{ $closet->ClosetName }}</h2>

        <p class="mb-5 text-center">{{ $closet->ClosetDescription }}</p>

        @include('alerts.success')
        @include('alerts.warning')

        <div class="row">

          @foreach($items as $item)

            <div class="col-sm-4 mb-4">

              <div class="card">
                <a href="{{ url('item',$item->first()->ItemID) }}"><img src="{{ url('storage/'.$item->first()->ThumbPath) }}" class="card-img-top" alt="..."></a>
                <div class="card-body">
                  <h5 class="card-title">{{ $item->first()->ActualPrice }}
                    <small class="line-through">{{ $item->first()->OriginalPrice }}</small>
                  </h5>
                </div>
              </div>

            </div>

          @endforeach

        </div>

      </div>
    </main>

@endsection
