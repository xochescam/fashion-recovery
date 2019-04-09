@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <h2 class="text-center mb-5"></h2>

        <a href="{{ url('item') }}" class="btn btn-fr mb-4">Subir prenda</a>

        <div class="row">

          @foreach($items as $item)

            <div class="col-sm-4 mb-4">

              <div class="card">
                <a href="{{ url('item',$item->first()->ItemID) }}"><img src="{{ url('storage/'.$item->first()->PicturePath) }}" class="card-img-top" alt="..."></a>
                <div class="card-body">
                  <h5 class="card-title">{{ $item->first()->ActualPrice }}
                    <small class="line-through">{{ $item->first()->OriginalPrice }}</small>
                    <span class="badge badge-secondary green-background float-right">{{ $item->first()->Discount }}%</span>
                  </h5>
                </div>
              </div>

            </div>

          @endforeach

        </div>

      </div>
    </main>

@endsection
