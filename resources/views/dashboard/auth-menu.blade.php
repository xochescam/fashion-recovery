  <a class="nav-link " href="#" role="button" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-shopping-cart"></i>
  </a>


<li class="nav-item dropdown ">
  <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{ Auth::User()->Alias }}
  </a>

  <div class="dropdown-menu btn-fr" aria-labelledby="navbarDropdown">
    <a class="dropdown-item text-left" href="{{ url('auth',Auth::User()->id) }}">Mi cuenta</a>

    @if(Auth::User()->ProfileID == 2)
      <div class="dropdown-divider"></div>
      <a class="dropdown-item text-left" href="{{ url('guardarropa') }}">Mi Guardarropa</a>
      <a class="dropdown-item text-left" href="{{ url('wishlists') }}">Mis Wishlists</a>
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

<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="far fa-bell"></i> </a>
  <div class="dropdown-menu dropdown-menu--notifications">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</li>