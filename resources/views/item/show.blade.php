@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <h2 class="text-center TituloFR my-4 mb-5 w-100">Ver prenda</h2>

        @include('alerts.success')
        @include('alerts.warning')
        
        <form method="POST" action="{{ url('add-items',$item->first()->ItemID) }}" class="mb-4" enctype="multipart/form-data">
          @csrf

          <div class="text-right">
            <label for="Items" class="btn btn-fr">
              Agregar fotos
              <input type="file" class="no-file js-add-items" id="Items" name="PicturesUploaded[]" multiple>
          </label>
          </div>
          
          <input type="hidden" name="realPicturesUploaded" class="js-input-real-pictures">

          <div class="text-right ml-2">
            <button class="btn btn-fr js-add-items-btn">Guardar</button>
          </div>
        </form>

        <div class="row">
          <div class=" col-4 ">
            <div class="card mb-4">
              <h5 class="card-header">{{ $item->first()->ActualPrice }}
                <small class="line-through">{{ $item->first()->OriginalPrice }}</small>
                @if($item->first()->OffSaleID !== null)
                  <span class="badge badge-secondary green-background float-right">{{ $offers[$item->first()->OffSaleID][0]->Discount }}%</span>
                @endif
              </h5>

              <div class="card-body">
                <form method="POST" action="{{ route('item.update',$item->first()->ItemID) }}" class="needs-validation" novalidate>
                  @csrf
                        
                  @include('item.form')

                  <div class="text-center mt-5">
                     <button type="submit" class="btn btn-fr w-50">Guardar</button>
                  </div>

                </form>
              </div>
            </div>
          </div>
          
          <div class="col-8">
            <div class="row js-items-container">
              @foreach($item as $picture)
                <div class="col-sm-4 mb-5 thumb-size">

                  <div class="card">
                    <img src="{{ url('storage/'.$picture->ThumbPath) }}" class="card-img-top" alt="...">
                    <a href="{{ route('item.destroy',$picture->ItemPictureID) }}" class="btn btn-danger btn-sm">Eliminar</a>
                  </div>

                </div>
              @endforeach
            </div>
          </div>

        </div>
      </div>
    </main>

@endsection
