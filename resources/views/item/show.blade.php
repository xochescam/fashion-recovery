@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <h2 class="text-center TituloFR my-4 mb-5 w-100">Ver prenda</h2>

        @include('alerts.success')
        @include('alerts.warning')

        <p class="text-right">
          <a class="btn btn-fr" data-toggle="collapse" href="#collapseEdit" role="button" aria-expanded="{{ count($errors) > 0 ? 'true' : 'false' }}" aria-controls="collapseEdit">
            Modificar
          </a>
        </p>
        <div class="collapse col-md-10 offset-md-1 {{ count($errors) > 0  ? 'show' : '' }}" id="collapseEdit">
          <div class="card">
            <h5 class="card-header">Modificar prenda</h5>

            <div class="card-body">
              <form method="POST" action="{{ route('item.update',$item->ItemID) }}" class="needs-validation" novalidate>
                @csrf

                @include('item.form')
                  
                <div class="text-center mt-5">
                  <button type="submit" class="btn btn-fr w-50 mb-2">
                    <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                    Guardar cambios
                  </button> <br>
                  <a href="{{ url('item/'.$item->ItemID.'/full-delete') }}" class="text-danger w-100">
                    <span class="spinner-border spinner-border-sm hidden " role="status" aria-hidden="true"></span>
                    Eliminar prenda
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
<!-- 
        <form method="POST" action="{{ url('add-items',$item->ItemID) }}" class="mb-4" enctype="multipart/form-data">
          @csrf

          <div class="text-right">
            <label for="Items" class="btn btn-fr">
              Agregar fotos
              <input type="file" class="no-file js-add-items" id="Items" name="PicturesUploaded[]" multiple>
          </label>
          </div>

          <input type="hidden" name="add_item_file" class="js-input-real-pictures">

          <div class="text-right ml-2">
            <button class="btn btn-fr js-add-items-btn">Guardar</button>
          </div>
        </form> -->

          <form method="POST" action="{{ url('add-items',$item->ItemID) }}" class="mb-4" enctype="multipart/form-data">

            <div class="d-flex flex-wrap justify-content-center justify-content-md-start mt-5 js-items-container">
              @csrf

              <div class="mb-3 thumb-size  mr-3">
                <div class="card no-border">
                  <input type="file" name="PicturesUploaded[]" id="Items" class="no-file js-add-items no-file custom-file-input" data-type="Foto frontal" data-name="front" accept=".png, .jpg, .jpeg"  multiple>
                  <label for="Items" class="card--file-item-add custom-file-label">
                    <span><i class="far fa-image"></i> <br>Agregar fotos</span>
                  </label>
                </div>

                <input type="hidden" name="add_item_file" class="js-input-real-pictures">

              </div>


              @foreach($images as $img)
                <div class="mb-3 thumb-size mr-3">
                  <div class="card">
                    <a href="{{ url('item/'.$img->ItemPictureID.'/'.$item->ItemID.'/delete') }}" class="close delete-item" aria-label="Close">
                    <i class="far fa-trash-alt"></i>
                    </a>
                    <img src="{{ url('storage/'.$img->ThumbPath) }}" class="card-img-top" alt="...">
                  </div>
                </div>
              @endforeach

              <div class="text-center text-sm-left w-100">
                <button class="btn btn-fr js-add-items-btn hidden">Guardar</button>
              </div>
            </div>
          </form>
      </div>
    </main>

@endsection
