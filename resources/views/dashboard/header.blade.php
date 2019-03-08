<nav id="header" class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <a class="navbar-brand" href="#">Panel de administración</a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="">Opción 1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Opción 2</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('logout') }}">Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>