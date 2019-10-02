<template>

  <div>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
<!-- 
          @if(Auth::User()->Notifications && count(Auth::User()->getNotifications()) > 0)
            <i class="fas fa-bell"></i><span class="badge badge-pill badge-light badge-notifications">{{ count(Auth::User()->getNotifications())}}</span>

          @else
            <i class="fas fa-bell"></i>

          @endif -->

        </a>
        <div class="dropdown-menu dropdown-menu--notifications">

 <!--          @if(count(Auth::User()->getNotifications()) > 0)
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
          @endif -->

      </div>
    </li>
  </div>
</template>

<script>
    export default {
        mounted() {
            console.log('NotificatiON.')
        }
    }
</script>
