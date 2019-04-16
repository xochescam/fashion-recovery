<main id="main">
  <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel" data-pause="false">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="{{ url('img/header/main/hipster.png') }}" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{ url('img/header/main/casual.png') }}" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{ url('img/header/main/sport.png') }}" alt="Third slide">
      </div>
      <div class="overlay">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6 offset-md-5 text-center text-md-right">
              <h1 class="fCooperHewitt"><b>FASHION RECOVERY</b></h1>
              <p class="d-none d-md-block">
                "La prenda más verde es la que ya existe." Juntos vamos a crear conciencia y cuidemos el planeta.
                Sé parte de este gran movimiento.<br />¡Te esperamos!
              </p>
              <a href="{{ url('/register/1') }}" class="btn btn-outline-light">Vende tu Guardarropa</a>
              <a href="{{ url('#offersDeLaSemana') }}" class="btn btn-fr" role="button">Comprar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="false"></span>
      <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="False"></span>
      <span class="sr-only">Siguiente</span>
    </a>
  </div>
</main>