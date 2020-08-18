<section id="offersDeLaSemana" class="mt-5">
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center text-uppercase mb-4">
        <small>Conoce nuestras</small>
        <h2>Ofertas de la semana</h2>
      </div>
    </div>
    <div class="row justify-content-start shadow-lg p-3 mb-5 bg-white rounded mx-md-5">
      @include('item.partials.card')

      <div class="text-center w-100">
        <a href="{{ url('search/all') }}" class="btn btn-fr mt-5 mb-2">Ver más</a>
      </div>
    </div>
  </div>
</section>
