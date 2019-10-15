  <a class="nav-link order-1 order-sm-1 text-left text-sm-center" href="{{ url('cart') }}" role="button" aria-haspopup="true" aria-expanded="false">

    @if( count(Auth::User()->getItems()) > 0)
      <i class="fas fa-shopping-cart"></i>
      <span class="badge badge-pill badge-light badge-notifications">{{ count(Auth::User()->getItems()) }}</span>
    @else
      <i class="fas fa-shopping-cart"></i>
    @endif

    <span class="ml-1 d-inline-block d-sm-none">Carrito</span>
  </a>


<li class="nav-item dropdown order-3 order-sm-2">
  <a class="nav-link dropdown-toggle float-left float-sm-none" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-user d-inline-block d-sm-none"></i>
    <span class="ml-1">{{ Auth::User()->Alias }}</span>
    
  </a>

  <div class="dropdown-menu btn-fr" aria-labelledby="navbarDropdown">
    <a class="dropdown-item text-left" href="{{ url('auth',Auth::User()->id) }}">Mi cuenta</a>
    <a class="dropdown-item text-left" href="{{ url('orders') }}">Mis pedidos</a>
<!--     <a class="dropdown-item text-left" href="{{ url('sells') }}">Mis ventas</a>
 -->
    @if(Auth::User()->ProfileID == 2)
      <div class="dropdown-divider"></div>
      <a class="dropdown-item text-left" href="{{ url('item') }}">Subir prenda</a>
      <a class="dropdown-item text-left" href="{{ url('guardarropa') }}">Mi Guardarropa</a>
      <a class="dropdown-item text-left" href="{{ url('wishlists') }}">Wish List</a>
  <!--     <a class="dropdown-item text-left" href="{{ url('followers') }}">Mis seguidores</a> -->
    @endif

    @if(Auth::User()->ProfileID > 2)
      <div class="dropdown-divider"></div>
      <a class="dropdown-item text-left" href="{{ url('#') }}">Administración</a>
    @endif


    <div class="dropdown-divider"></div>
<!--     <a class="dropdown-item text-left" href="{{ url('update-password') }}">Cambiar contraseña</a>
 -->    <a class="dropdown-item text-left" href="{{ route('logout') }}">Cerrar sesión</a>
  </div>
</li>

<li class="nav-item dropdown order-2 order-sm-3">
  <a class="nav-link dropdown-toggle float-left float-sm-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">

    @if(count(Auth::User()->getNotifications()) > 0)
      <i class="fas fa-bell"></i><span class="badge badge-pill badge-light badge-notifications">{{ count(Auth::User()->getNotifications())}}</span>
    @else
      <i class="fas fa-bell"></i>
    @endif
    <span class="ml-1 d-inline-block d-sm-none">Notificaciones</span>

  </a>
  <div class="dropdown-menu dropdown-menu--notifications">

    @if(Auth::User()->Notifications && count(Auth::User()->getNotifications()) > 0)
      @foreach(Auth::User()->getNotifications() as $notification)
        
          @if($notification->Type == 'follower')
            <a class="dropdown-item text-left" href="{{ url('followers') }}">
              <i class="far fa-user pr-1"></i>
              Tienes un nuevo seguidor.
            </a>

          @elseif($notification->Type == 'question')
            <a class="dropdown-item text-left" href="{{ url('question/'.$notification->TableID.'/answer') }}">
              <i class="far fa-comment pr-1"></i>
              Tienes una nueva pregunta.
            </a>

          @elseif($notification->Type == 'answer')

            <a class="dropdown-item text-left" href="{{ url('question/'.$notification->TableID.'/question') }}">
              <i class="far fa-comments pr-1"></i>
              Tienes respuestas por leer.
            </a>

          @endif
        
        </a>
      @endforeach

    @else
      <a href="#" class="dropdown-item text-left">No tienes notificaciones</a>
    @endif

  </div>
</li>