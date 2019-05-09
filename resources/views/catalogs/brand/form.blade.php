  @csrf

  @include('alerts.success')
  @include('alerts.warning')


    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" class="form-control is-invalid" name="name" id="name" value=" {{ isset($brand->BrandName) ? $brand->BrandName : old('name') }}">

      @if ($errors->has('name'))
        <div class="invalid-feedback">
          {{ $errors->first('name') }}
        </div>
      @endif
    </div>

	    <div class="form-group">
      <label for="departmentId">Departamento</label>
      <select id="departmentId" class="form-control is-invalid" name="departmentId">
        <option value="" selected>- Seleccionar -</option>

            @foreach($departments as $item)
              <option value="{{ $item->DepartmentID }}"  {{ (isset($brand->DepartmentID) && ($item->DepartmentID == $brand->DepartmentID) || old('departmentId'))  ? 'selected' : '' }} > {{ $item->DepName }} </option>
            @endforeach
      </select>

        @if ($errors->has('departmentId'))
            <div class="invalid-feedback">
              {{ $errors->first('departmentId') }}
            </div>
        @endif
    </div>

	  <div class="form-group">
    	<div class="form-check">
            <input class="form-check-input is-invalid" type="checkbox" id="active" name="active" value="{{ (isset($brand->Active) && $brand->Active) ? 'true' : 'false'  }}" {{ isset($brand->Active) ? ($brand->Active == 1 ? 'checked' : '' ) : 'checked'}}>
            <label class="form-check-label" for="active">
            	Activa
            </label>
      </div>
    </div>

  <button type="submit" class="btn btn-fr btn-block">Guardar</button>