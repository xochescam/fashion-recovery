<nav id="header" class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">
          <img src="{{ url('img/header/transparent_logo.png') }}" alt="Fashion Recovery"/>
      </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

    @can('create-category')
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('reportes') }}">Reportes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('users') }}">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('returns') }}">Devoluciones</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Catálogos</a>
            <div class="dropdown-menu">
              <a class="dropdown-item text-left" href="{{ url('departments') }}">Departamentos</a>
              <a class="dropdown-item text-left" href="{{ url('categories') }}">Categorías</a>
              <a class="dropdown-item text-left" href="{{ url('brands') }}">Marcas</a>
              <a class="dropdown-item text-left" href="{{ url('clothing-types') }}">Tipos de prendas</a>
              <a class="dropdown-item text-left" href="{{ url('sizes') }}">Tallas</a>
              <a class="dropdown-item text-left" href="{{ url('colors') }}">Colores</a>
              <a class="dropdown-item text-left" href="{{ url('types') }}">Condiciones</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-left" href="{{ url('seasons') }}">Temporadas</a>
              <a class="dropdown-item text-left" href="{{ url('calendar-sales') }}">Calendario de ofertas</a>
            </div>
          </li>
          
        </ul>
      @endcan

      <ul class="navbar-nav ml-auto">

        @can('create-seller')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('seller') }}">¿Quieres Vender?</a>
          </li>
        @endcan

        @include('dashboard.auth-menu')
        
      </ul>
    </div>
  </div>
</nav>