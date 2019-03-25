<nav id="header" class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ url('img/header/transparent_logo.png') }}" alt="Fashion Recovery"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form class="form-inline my-2 my-lg-0 mr-auto">
        <input class="form-control mr-sm-2" type="search" placeholder="Buscar en Guardarropas..." aria-label="Search">
        <button class="btn btn-outline-light my-2 my-sm-0 mx-2" type="submit">Buscar</button>
      </form>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ Auth::User() !== null ? url('seller') : url('register') }}">¿Quieres Vender?</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Mi Perfil
          </a>
          <div class="dropdown-menu  btn-fr" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ url('data') }}">Mis Datos</a>
            <a class="dropdown-item" href="{{ url('') }}">Mis Preferencias</a>
            <a class="dropdown-item" href="{{ url('') }}">Whish List</a>
            <a class="dropdown-item" href="{{ url('') }}">Mis Pedidos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ url('') }}">Mi Guardarropa</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ url('') }}">Administración</a>
          </div>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="{{ url('login') }}">Iniciar Sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>