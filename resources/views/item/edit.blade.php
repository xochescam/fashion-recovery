@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
          <h2 class="text-center TituloFR my-4 mb-5 w-100">Editar prenda</h2>

          <p class="text-center mb-5 w-100">Cambio ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

          <div class="col-md-8 offset-md-2 mb-4">
              <a href="{{ url('items/'.$item->ItemID.'/public') }}" target="_blank" class="btn btn-fr mb-4 float-right">
                Visualizar prenda 
              </a>
            </div>

          <div class="col-md-8 offset-md-2">
            <form method="POST" action="{{ route('item.update',$item->ItemID) }}" class="needs-validation" enctype="multipart/form-data" novalidate>

            

              <div id="app">
              @include('item.form')
              </div>

              <div class="text-center mt-5 row">
                <div class="col-md-6">
                  <a href="{{ url('item/'.$item->ItemID.'/full-delete') }}" class="btn btn-danger w-100">
                    <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                    Eliminar prenda
                  </a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-fr w-100">
                    <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                    Guardar cambios
                  </button>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection