<div class="form-group col-md-6">
    <label for="DepartmentID">Departamento *</label>

    <select-component
      class="form-control js-departments-select"
      id="DepartmentID"
      name="DepartmentID"
      initial="{{ isset($item->DepartmentID) ? $item->DepartmentID : '' }}"
      :options="{{ json_encode($departments) }}"
    ></select-component>
    <small>Ejemplo: Niños, Niñas, Hombres...</small>

    @if ($errors->has('DepartmentID'))
        <div class="invalid-feedback">
          {{ $errors->first('DepartmentID') }}
        </div>
    @else
      <div class="invalid-feedback">
        El campo departamento es obligatorio.
      </div>
    @endif
  </div>