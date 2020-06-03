<div class="card mb-4" id="followersData">
  <h5 class="card-header">Mis vendedores</h5>

  <div class="card-body">

        @if(count(Auth::User()->getFollowers()['following']) === 0)
        <p class="h6 my-5"> No sigues a ningún vendedor. </p>                      
        @endif

        <ul class="list-group list-group-flush">
            @foreach(Auth::User()->getFollowers()['following'] as $follow)
                <li class="list-group-item d-flex align-items-center"> 
                    <a href="{{ url('user',$follow->Alias) }}" class="no-text-decoration green-link align-items-center row">
                        <p class="text-left m-0">{{ $follow->Alias }}</p>
                    </a>
                    <div class="w-100 text-right">
                        <a href="{{ url('unfollow',$follow->id) }}" class="btn btn-fr btn-sm d-inline-flex align-items-center">
                        <i class="fas fa-check"></i>
                        <p class="pl-1 m-0 d-md-block d-none">Dejar de seguir</p>
                        </a>
                    </div>
                </li>                          
            @endforeach
        </ul>
  </div>
</div>