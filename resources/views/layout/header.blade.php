<nav id="header" class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ url('img/header/transparent_logo.png') }}" alt="Fashion Recovery"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 mr-auto" action="/search" method="get">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar en Guardarropa" aria-label="Search" name="criteria">
            <button class="btn btn-outline-light my-2 my-sm-0 mx-2" type="submit">Buscar</button>
        </form>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ Auth::User() !== null ? url('seller') : url('register',1) }}">¿Quieres vender?</a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="{{ url('login',0) }}">Iniciar sesión</a>
        </li>
        </ul>
    </div>
  </div>
</nav>
