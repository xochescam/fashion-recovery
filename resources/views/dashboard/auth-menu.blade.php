  <a class="nav-link order-1 order-sm-2 text-left text-sm-center pl-2 pl-sm-0" href="{{ url('shopping-cart') }}" role="button" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-shopping-cart"></i>
    <span class="badge badge-pill badge-light badge-notifications">{{ count(Auth::User()->getItems()) }}</span>
    <span class="ml-1 d-inline-block d-sm-none">Carrito</span>
  </a>


<li class="nav-item dropdown order-3 order-sm-3">
  <a class="nav-link dropdown-toggle float-left float-sm-none pl-2 pl-sm-0 text-left dropdown-option" 
    id="navbarDropdown" role="button" data-toggle="dropdown" 
    aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-user d-inline-block d-sm-none"></i>
    <span class="ml-1">{{ Auth::User()->Alias }}</span>
    
  </a>

  <div class="dropdown-menu bg-light size-14 mt-sm-3" aria-labelledby="navbarDropdown">
    <a class="dropdown-item text-left bg-light" href="{{ url('auth',Auth::User()->id) }}">Mi Cuenta</a>
    <a class="dropdown-item text-left bg-light" href="{{ url('orders') }}">Mis Pedidos</a>
<!--     <a class="dropdown-item text-left" href="{{ url('sells') }}">Mis ventas</a>
 -->
    @if(Auth::User()->ProfileID == 2)
      <div class="dropdown-divider"></div>
      <a class="dropdown-item text-left bg-light" href="{{ url('item') }}">Subir Prenda</a>
      <a class="dropdown-item text-left bg-light" href="{{ url('guardarropa') }}">Mi Clóset</a>
      <a class="dropdown-item text-left bg-light" href="{{ url('wishlists') }}">Mis Favoritos</a>
  <!--     <a class="dropdown-item text-left" href="{{ url('followers') }}">Mis seguidores</a> -->
    @endif

    @if(Auth::User()->ProfileID > 2)
      <div class="dropdown-divider"></div>
      <a class="dropdown-item text-left" href="{{ url('dashboard') }}">Administración</a>
    @endif


    <div class="dropdown-divider"></div>
<!--     <a class="dropdown-item text-left" href="{{ url('update-password') }}">Cambiar contraseña</a>
 -->    <a class="dropdown-item text-left bg-light" href="{{ route('logout') }}">Cerrar Sesión</a>
  </div>
</li>

@if(isset(Auth::User()->id))
  <notifications
    :notifications="{{ Auth::User()->getNotifications() }}"
  ></notifications>
@endif