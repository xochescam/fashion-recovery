@csrf

@include('alerts.success')
@include('alerts.warning')

  <div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" class="form-control" name="name" id="name" value=" {{ isset($category->CategoryName) ? $category->CategoryName : old('name') }}">

    @if ($errors->has('name'))
      <div class="invalid-feedback">
        {{ $errors->first('name') }}
      </div>
    @endif
  </div>

  <div class="form-group">
    <label for="DepartmentID">Departamento</label>
    <select id="DepartmentID" class="form-control js-departments-select" name="DepartmentID" required data-size="false">
      <option value="" selected>- Seleccionar -</option>

        @foreach($departments as $item)
          <option value="{{ $item->DepartmentID }}"  {{ (isset($category->DepartmentID) && ($item->DepartmentID == $category->DepartmentID) || old('departmentId'))  ? 'selected' : '' }} > {{ $item->DepName }} </option>
        @endforeach
    </select>

    @if ($errors->has('DepartmentID'))
      <div class="invalid-validation">
        {{ $errors->first('DepartmentID') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo departamento es obligatorio.
      </div>
    @endif
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="active" name="active" value="{{ (isset($category->Active) && $category->Active) ? 'true' : 'false'  }}" {{ isset($category->Active) ? ($category->Active == 1 ? 'checked' : '' ) : 'checked'}}>
      <label class="form-check-label" for="active">
        Activa
      </label>
    </div>
  </div>

<button type="submit" class="btn btn-fr btn-block">
  <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
  Guardar
</button>