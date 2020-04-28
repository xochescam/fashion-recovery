@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-10 offset-md-1">
            <h2 class="text-center TituloFR my-4 mb-5">¡Únete al movimiento!</h2>

            <p class="mb-5">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis nemo eaque nihil odio? Molestiae eligendi omnis laudantium, est quis blanditiis aliquid tempora. Nam autem a facilis non tempore velit! Hic?</p>
            
            <h5 class="mb-4 TituloFR">Cuida al planeta vendiendo tu Guardarropa</h5>

            <div class="row">
              <div class="col-sm-4 mb-4">
                <div class="card">
                  <img src="..." class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">1. Agrega tus prendas</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 mb-4">
                <div class="card">
                  <img src="..." class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">2. Envialo con amor</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 mb-4">
                <div class="card">
                  <img src="..." class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">3. ¡Haz la diferencia!</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="w-100 text-right mb-4">
              <a href="{{ url('/item') }}" class="btn btn-fr" role="button">Vende tu Guardarropa</a>
            </div>

            <hr class="my-5">

            <h5 class="mb-4 TituloFR">Súmate adquiriendo prendas únicas</h5>

            <div class="row">
              <div class="col-sm-4 mb-4">
                <div class="card">
                  <img src="..." class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">1. Busca tu prenda ideal</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 mb-4">
                <div class="card">
                  <img src="..." class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">2. Adquiere la prenda</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 mb-4">
                <div class="card">
                  <img src="..." class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">3. ¡Dale un segundo uso!</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="w-100 text-right">
              <a href="{{ url('/') }}" class="btn btn-fr" role="button">Buscar prendas</a>
            </div>


          </div>
        </div>
      </div>
    </main>
@endsection
