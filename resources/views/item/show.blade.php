@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <h2 class="text-center mb-5">Ver prenda</h2>

        @include('alerts.success')
        @include('alerts.warning')

        <div class="text-right">
          <a href="#" class="btn btn-fr mb-4">Agregar fotos</a>
        </div>

        <div class="row">

          <div class="col-4 card mr-4">
            <div class="card-body">
              <h5>{{ $item->first()->ActualPrice }}
                <small class="line-through">{{ $item->first()->OriginalPrice }}</small>
                <span class="badge badge-secondary green-background float-right">{{ $item->first()->Discount }}%</span>
              </h5>

              <hr>

              <div class="text-right">
                <a href="{{ url('item/'.$item->first()->ItemID.'/edit') }}" class="btn btn-fr btn-sm mb-4">Modificar datos</a>
              </div>

              <p class="card-text">Color: <br> {{ $item->first()->ColorName }} </p>

              <p class="card-text">Tamaño: <br> {{ $item->first()->SizeName }} </p>

              <p class="card-text">Tipo de ropa: <br> {{ $item->first()->ClothingTypeName }} </p>

              <p class="card-text">Departamento: <br> {{ $item->first()->DepName }} </p>

              <p class="card-text">Categoria: <br> {{ $item->first()->CategoryName }} </p>

              <p class="card-text">Tipo: <br> {{ $item->first()->TypeName }} </p>

              <p class="card-text">Closet: <br> {{ $item->first()->ClosetName }} </p>
            </div>

          </div>

          <div class="col-8 row">

            @foreach($item as $picture)
              <div class="col-sm-4 mb-4">

                <div class="card">
                  <img src="{{ url('storage/'.$picture->PicturePath) }}" class="card-img-top" alt="...">
                  <a href="{{ route('item.destroy',$picture->ItemPictureID) }}" class="btn btn-danger btn-sm">Eliminar</a>
                </div>

              </div>
            @endforeach
          </div>

        </div>
      </div>
    </main>

@endsection
