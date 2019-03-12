<nav id="header" class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <a class="navbar-brand" href="#">Panel de administración</a>
      <ul class="navbar-nav">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Marcas</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('brands') }}">Lista</a>
            <a class="dropdown-item" href="{{ url('/brands/create') }}">Crear</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Departamentos</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('departments') }}">Lista</a>
            <a class="dropdown-item" href="{{ url('/departments/create') }}">Crear</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categorias</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('categories') }}">Lista</a>
            <a class="dropdown-item" href="{{ url('/categories/create') }}">Crear</a>
          </div>
        </li>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('logout') }}">Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>