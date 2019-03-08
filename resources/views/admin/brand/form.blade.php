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
            <option value="1">Opción 1</option>
            <option value="2">Opción 2</option>
            <option value="3">Opción 4</option>
        </select>

        @if ($errors->has('departmentId'))
            <div class="invalid-feedback">
              {{ $errors->first('departmentId') }}
            </div>
        @endif
    </div>

	  <div class="form-group">
    	<div class="form-check">
            <input class="form-check-input is-invalid" type="checkbox" id="active" name="active" value="{{ (isset($brand->Active) && $brand->Active) ? 'true' : 'false'  }}" {{ (isset($brand->Active) && $brand->Active) ? 'checked' : ''  }}>
            <label class="form-check-label" for="active">
            	Activa
            </label>
      </div>
    </div>

  <button type="submit" class="btn btn-fr btn-block">Guardar</button>