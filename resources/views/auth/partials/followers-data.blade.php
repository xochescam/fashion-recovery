<div class="card mb-4" id="followersData">
  <h5 class="card-header">Mis seguidores</h5>

  <div class="card-body">
    <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="green-link nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Seguidores</a>
                <a class="green-link nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Seguidos</a>
              </div>
    </nav>

            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                @if(count(Auth::User()->getFollowers()['followers']) === 0)
                  <p class="h6 my-5 text-center"> No tienes seguidores. </p>                      
                @endif

                <ul class="list-group list-group-flush mt-3">
                  @foreach(Auth::User()->getFollowers()['followers'] as $follower)
                    <li class="list-group-item d-flex align-items-center"> 
                      <a href="{{ url('user',$follower->Alias) }}" class="no-text-decoration green-link align-items-center row">
                       {{ $follower->Alias }}
                      </a>
                    </li> 
                     
                  @endforeach
                </ul>

              </div>
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                @if(count(Auth::User()->getFollowers()['following']) === 0)
                  <p class="h6 my-5 text-center"> No sigues a ningún vendedor. </p>                      
                @endif
                
                <ul class="list-group list-group-flush mt-3">
                  @foreach(Auth::User()->getFollowers()['following'] as $follow)
                    <li class="list-group-item d-flex align-items-center"> 
                      <a href="{{ url('user',$follow->Alias) }}" class="w-100 no-text-decoration green-link align-items-center row">                       
                      {{ $follow->Alias }}
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
  </div>
</div>