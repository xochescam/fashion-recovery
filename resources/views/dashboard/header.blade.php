<nav id="header" class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <a class="navbar-brand" href="{{ url('dashboard') }}">
          <img src="{{ url('img/header/transparent_logo.png') }}" alt="Fashion Recovery"/>
      </a>

      @if(Auth::User()->ProfileID == 4)
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Catálogos</a>
            <div class="dropdown-menu">
              <a class="dropdown-item text-left" href="{{ url('departments') }}">Departamentos</a>
              <a class="dropdown-item text-left" href="{{ url('brands') }}">Marcas</a>
              <a class="dropdown-item text-left" href="{{ url('categories') }}">Categorias</a>
              <a class="dropdown-item text-left" href="{{ url('types') }}">Tipos</a>
              <a class="dropdown-item text-left" href="{{ url('colors') }}">Colores</a>
              <a class="dropdown-item text-left" href="{{ url('clothing-types') }}">Tipos de ropa</a>
              <a class="dropdown-item text-left" href="{{ url('sizes') }}">Tamaños</a>
              <a class="dropdown-item text-left" href="{{ url('seasons') }}">Temporadas</a>
              <a class="dropdown-item text-left" href="{{ url('calendar-sales') }}">Calendario de ofertas</a>
            </div>
          </li>
        </ul>
      @endif

      <ul class="navbar-nav ml-auto">

        @if(Auth::User()->ProfileID == 1)
          <li class="nav-item">
            <a class="nav-link" href="{{ url('seller') }}">¿Quieres Vender?</a>
          </li>
        @endif

        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Mi Perfil
          </a>

          <div class="dropdown-menu btn-fr" aria-labelledby="navbarDropdown">
            <a class="dropdown-item text-left" href="{{ url('auth',Auth::User()->id) }}">Mis Datos</a>
            <a class="dropdown-item text-left" href="{{ url('#') }}">Mis Preferencias</a>
            <a class="dropdown-item text-left" href="{{ url('#') }}">Whish List</a>
            <a class="dropdown-item text-left" href="{{ url('#') }}">Mis Pedidos</a>
            
            @if(Auth::User()->ProfileID == 2)
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-left" href="{{ url('guardarropas') }}">Mi Guardarropa</a>
            @endif

            @if(Auth::User()->ProfileID > 2)
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-left" href="{{ url('#') }}">Administración</a>
            @endif


            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-left" href="{{ url('update-password') }}">Cambiar contraseña</a>
            <a class="dropdown-item text-left" href="{{ route('logout') }}">Cerrar sesión</a>
          </div>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="#">{{ Auth::User()->Alias }}</a>
        </li>
      </ul>
    </div>
  </div>
</nav>