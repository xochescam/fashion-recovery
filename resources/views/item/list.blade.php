@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <h2 class="text-center TituloFR my-4 mb-5 w-100">Mis prendas</h2>

        <p class="text-center mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

        <div class="text-right w-100">
          <a href="{{ url('item') }}" class="btn btn-fr mb-4">Subir prenda</a>
        </div>

        <div class="row">

          @foreach($items as $item)

            <div class="col-sm-4 mb-4">
              <div class="card">
                <a href="{{ url('item',$item->first()->ItemID) }}"><img src="{{ url('storage/'.$item->first()->ThumbPath) }}" class="card-img-top" alt="..."></a>
                <div class="card-body">
                  <h5 class="card-title">{{$item->first()->ItemDescription}}</h5>
                  <p class="card-text">{{ $item->first()->ActualPrice }}
                    <small class="line-through">{{ $item->first()->OriginalPrice }}</small>
                  </p>
                </div>
              </div>

            </div>

          @endforeach

        </div>

      </div>
    </main>

@endsection
