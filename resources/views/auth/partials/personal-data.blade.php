<div class="card mb-4" id="personalData">
  <h5 class="card-header">Datos personales</h5>

  <div class="card-body">

    <form method="POST" action="{{ url('auth',Auth::User()->id) }}" class="needs-validation" novalidate>
       @csrf

      <div class="form-group row">
        <label for="Alias" class="col-sm-3 col-form-label">Alias</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="Alias" id="Alias" value="{{ Auth::User()->Alias }}" required>

          @if ($errors->has('Alias'))
            <div class="invalid-validation">
              {{ $errors->first('Alias') }}
            </div>
          @else
            <div class="invalid-feedback">
              El campo Alias es obligatorio.
            </div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label for="Name" class="col-sm-3 col-form-label">Nombre</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="Name" id="Name" value="{{ Auth::User()->Name }}">

          @if ($errors->has('Name'))
            <div class="invalid-validation">
              {{ $errors->first('Name') }}
            </div>
          @endif
        </div>
      </div>

       <div class="form-group row">
        <label for="last_name" class="col-sm-3 col-form-label">Apellidos</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="last_name" id="last_name" value="{{ Auth::User()->Lastname }}">

          @if ($errors->has('last_name'))
            <div class="invalid-validation">
              {{ $errors->first('last_name') }}
            </div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">Correo electrónico</label>
        <div class="col-sm-9">
          <input type="email" class="form-control" name="email" id="email" value="{{ Auth::User()->email }}" required>

          @if ($errors->has('email'))
            <div class="invalid-validation">
              {{ $errors->first('email') }}
            </div>
          @else
            <div class="invalid-feedback">
              Ingresa un correo electrónico válido.
            </div>
          @endif

        </div>
      </div>

      <div class="form-group row">
          <label class="col-sm-3 col-form-label" for="gender">Género</label>
          <div class="col-sm-9">
            <select id="gender" class="form-control" name="gender" >
              <option value="" selected>- Seleccionar -</option>
              <option value="Masculino" {{ Auth::User()->Gender == 'Masculino' || old('gender') == 'Masculino' ? 'selected' : ''}}>Masculino</option>
              <option value="Femenino" {{ Auth::User()->Gender == 'Femenino' ||old('gender') == 'Femenino' ? 'selected' : ''}}>Femenino</option>
              <option value="Indefinido" {{ Auth::User()->Gender == 'Indefinido' || old('gender') == 'Indefinido' ? 'selected' : ''}}>Prefiero no decirlo</option>
            </select>

            @if ($errors->has('gender'))
              <div class="invalid-feedback">
                {{ $errors->first('gender') }}
              </div>
            @endif
          </div>
      </div>

      <div class="form-group row">
          <label for="birth_date" class="col-sm-3 col-form-label">Fecha de nacimiento</label>

        <div class="form-group col-md-9">
          @include('auth.partials.birthdate')
        </div>

      </div>

       <div class="form-group row">
        <label class="col-sm-3 col-form-label">Miembro desde</label>
        <label class="col-sm-9 col-form-label text-left">{{ $creationDateUser }}</label>
      </div>

      <div class="w-auto float-right">
        <button class="btn btn-fr">
          <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
          Guardar
        </button>
      </div>
    </form>
  </div>
</div>