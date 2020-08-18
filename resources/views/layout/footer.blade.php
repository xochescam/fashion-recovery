<footer>
  <div class="footer-main pb-4 pt-4">
    <div class="container container-fluid">
      <div class="row my-5">

        <div class="col-md-3 mb-4 mb-md-0">
          <h5 class="text-light">Fashion Recovery</h5>
          <a href="{{ url('support') }}">¿Cómo funciona?</a> <br>
          <a href="{{ url('about') }}">Acerca de Nosotros</a>
        </div>

        <div class="col-md-3 mb-4 mb-md-0">
          <h5 class="text-light">Información general</h5>
          <a href="{{ url('faq') }}">Preguntas Frecuentes</a> <br>
          <a href="{{ url('terms') }}">Términos y condiciones</a> <br>
          <a href="{{ url('privacy') }}">Aviso de Privacidad</a> <br>
          <a href="{{ url('return-policy') }}">Política de Devolución</a>
        </div>

        <div class="col-md-6">

          <form method="POST" action="{{ url('newsletter') }}" class="form-inline row needs-validation" novalidate>
            @csrf
            
            <div class="w-100">
              @include('alerts.success')
              @include('alerts.warning')
            </div>

            <div class="form-group mb-2 col-md-8">
              <label for="email" class="mb-2 font-15">¡Se parte de nuestra comunidad!</label>
              <input type="email" class="form-control w-100" name="email" id="email" placeholder="Ingresa tu email" required>

              @if ($errors->has('email'))
                <div class="invalid-validation">
                  {{ $errors->first('email') }}
                </div>
              @else
                <div class="invalid-feedback">
                  Ingresa tu email
                </div>
              @endif

            </div>
            <div class="form-group mb-2 col-md-4">
              <button type="submit" class="btn btn-outline-light btn-block mt-4">Suscribirme</button>
            </div>
          </form> 

          <div class="mt-5">
            <p class="font-15">Sigue nuestras redes sociales y no te pierdas las últimas noticias.</p>

            <a href="#" class="mr-4 text-light">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="mr-4 text-light">
              <i class="fab fa-twitter" ></i>
            </a>
            <a href="#" class="text-light">
              <i class="fab fa-instagram"></i>
            </a>
            
          </div>  
        </div>

      </div>

      <p class="text-center w-100 mt-3 mb-0 color-white">© FASHION RECOVERY, todos los derechos reservados</p>
    </div>  
  </div>

</footer>