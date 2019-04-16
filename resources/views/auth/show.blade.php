@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <h2 class="text-center TituloFR my-4">Mis datos</h2>
          </div>

          <div class="col-md-3">
            <ul class="list-group list-group-flush">
              <a href="#" class="list-group-item list-group-item-action text-left">
                Cras justo odio
              </a>
              <a href="#" class="list-group-item list-group-item-action text-left">
                Cras justo odio
              </a>
              <a href="#" class="list-group-item list-group-item-action text-left">
                Cras justo odio
              </a>
              <a href="#" class="list-group-item list-group-item-action text-left">
                Cras justo odio
              </a>
              <a href="#" class="list-group-item list-group-item-action text-left">
                Cras justo odio
              </a>
            </ul>
          </div>

          <div class="col-md-9">
              <div class="card">
                <h5 class="card-header">Datos personales</h5>

                <div class="card-body">
{{--                   <div class="w-auto float-right mb-4">
                    <a class="btn btn-fr" href="{{ url('auth/'.(Auth::User()->id).'/edit') }}" role="button">Modificar datos</a>
                  </div> --}}

                  <h5 class="card-title">Alias:</h5>
                  <p class="card-text"> {{ Auth::User()->Alias }} </p>

                  <h5 class="card-title">Nombre:</h5>
                  <p class="card-text"> {{ Auth::User()->Name }} {{ Auth::User()->Lastname }} </p>

                  <h5 class="card-title">Correo electrónico:</h5>
                  <p class="card-text"> {{ Auth::User()->email }} </p>

                  <h5 class="card-title">Género:</h5>
                  <p class="card-text"> {{ Auth::User()->Gender }} </p>

                  <h5 class="card-title">Fecha de nacimiento:</h5>
                  <p class="card-text"> {{ $birthDateUser }} </p>

                  <h5 class="card-title">Miembro desde:</h5>
                  <p class="card-text"> {{ $creationDateUser }} </p>
                </div>
              </div>

            @if(Auth::User()->ProfileID == 2)
                <div class="card">
                  <h5 class="card-header">Datos de vendedor</h5>

                  <div class="card-body">
                    <div class="w-auto float-right mb-4">
                      <a class="btn btn-fr" href="{{ url('seller/'.$seller->SellerID.'/edit') }}" role="button">Modificar datos</a>
                    </div>

                    <h5 class="card-title">Saludo:</h5>
                    <p class="card-text"> {{ $seller->Greeting }} </p>

                    <h5 class="card-title">Acerca de mi:</h5>
                    <p class="card-text"> {{ $seller->AboutMe }} </p>

                    <h5 class="card-title">Lugar de residencia:</h5>
                    <p class="card-text"> {{ $seller->LiveIn }} </p>

                    <h5 class="card-title">Lugar de trabajo:</h5>
                    <p class="card-text"> {{ $seller->WorkIn }} </p>

                    <h5 class="card-title">Total de evaluaciones:</h5>
                    <p class="card-text"> {{ $seller->TotalEvaluations }} </p>

                    <h5 class="card-title">Total de ventas:</h5>
                    <p class="card-text"> {{ $seller->ItemsSold }} </p>

                    <h5 class="card-title">Total de devoluciones:</h5>
                    <p class="card-text"> {{ $seller->ItemsReturned }} </p>

                    <h5 class="card-title">Raking:</h5>
                    <p class="card-text"> {{ $seller->Ranking }} </p>

                    <h5 class="card-title">Documento de identificación:</h5>
                    <img src="{{ url($seller->IdentityDocumentPath) }}" alt="">

                    <h5 class="card-title">Vendedor desde:</h5>
                    <p class="card-text"> {{ $sellerSince }} </p>
                  </div>
                </div>
            @endif
          </div>
          
        </div>
      </div>
    </main>
@endsection