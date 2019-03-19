<nav id="header" class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <a class="navbar-brand" href="{{ url('dashboard') }}">Panel de administración</a>
      <ul class="navbar-nav">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Catálogos</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('departments') }}">Departamentos</a>
            <a class="dropdown-item" href="{{ url('brands') }}">Marcas</a>
            <a class="dropdown-item" href="{{ url('categories') }}">Categorias</a>
            <a class="dropdown-item" href="{{ url('types') }}">Tipos</a>
            <a class="dropdown-item" href="{{ url('colors') }}">Colores</a>
            <a class="dropdown-item" href="{{ url('sizes') }}">Tamaños</a>
            <a class="dropdown-item" href="{{ url('clothing-types') }}">Tipos de ropa</a>
            <a class="dropdown-item" href="{{ url('seasons') }}">Temporadas</a>
            <a class="dropdown-item" href="{{ url('calendar-sales') }}">Calendario de ofertas</a>
          </div>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            {{ Auth::User()->Name }}
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('update-password') }}">Cambiar contraseña</a>
            <a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a>
          </div>
        </li>

      </ul>
    </div>
  </div>
</nav>