<div class="form-group col-md-6">
    <label for="DepartmentID">Departamento *</label>
    <select id="DepartmentID" class="form-control js-departments-select " name="DepartmentID"  data-size="false" required>
      <option value="" selected>- Seleccionar -</option>
        @foreach($departments as $department)
          <option value="{{ $department->DepartmentID }}"  
            {{ old('DepartmentID') && (old('DepartmentID') == $department->DepartmentID) ? 'selected' :  ($item && ($department->DepartmentID == $item->DepartmentID) ? 'selected' : '') }}>
            {{ $department->DepName }}
          </option>
        @endforeach
    </select>
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