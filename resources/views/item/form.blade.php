@csrf

@if(!$item)
  @include('alerts.success')
  @include('alerts.warning')
@endif

@if(!$item)
 <div>
<label>Fotos de la prenda *</label>

 <div class="row js-items-container mt-2 text-center">
   <div class="col-sm-4 mb-5 thumb-size js-item-picture">
      <input type="file" name="cover_item_file" id="cover_item_file" class="no-file js-item-file custom-file-input" data-type="Portada" data-name="cover" accept=".png, .jpg, .jpeg" required>
      <label for="cover_item_file" class="card card--file-item custom-file-label">
        <span><i class="far fa-image"></i> <br>Portada</span>
      </label>

      <div class="container-item-img"></div>

      @if ($errors->has('cover_item_file'))
        <div class="invalid-validation mb-2">
          {{ $errors->first('cover_item_file') }}
        </div>
      @else
        <div class="invalid-feedback mb-2">
          Selecciona la foto de la portada de la prenda.
        </div>
      @endif
    </div>

    <div class="col-sm-4 mb-5 thumb-size js-item-picture">
      <input type="file" name="front_item_file" id="front_item_file" class="no-file js-item-file custom-file-input" data-type="Foto frontal" data-name="front" accept=".png, .jpg, .jpeg"  required>
      <label for="front_item_file" class="card card--file-item custom-file-label">
        <span><i class="far fa-image"></i> <br>Foto frontal</span>
      </label>

      <div class="container-item-img"></div>

      @if ($errors->has('front_item_file'))
        <div class="invalid-validation mb-2">
          {{ $errors->first('front_item_file') }}
        </div>
      @else
        <div class="invalid-feedback mb-2">
          Selecciona la foto de la portada de la prenda.
        </div>
      @endif
    </div>

    <div class="col-sm-4 mb-5 thumb-size js-item-picture">
      <input type="file" name="label_item_file" id="label_item_file" class="no-file js-item-file custom-file-input" data-type="Foto de la etiqueta" data-name="label" accept=".png, .jpg, .jpeg"  required>
      <label for="label_item_file" class="card card--file-item custom-file-label">
        <span><i class="far fa-image"></i> <br>Foto de la etiqueta</span>
      </label>

      <div class="container-item-img"></div>

      @if ($errors->has('label_item_file'))
        <div class="invalid-validation mb-2">
          {{ $errors->first('label_item_file') }}
        </div>
      @else
        <div class="invalid-feedback mb-2">
          Selecciona la foto de la portada de la prenda.
        </div>
      @endif
    </div>

    <div class="col-sm-4 mb-5 thumb-size js-item-picture">
      <input type="file" name="back_item_file" id="back_item_file" class="no-file js-item-file custom-file-input" data-type="Foto de espaldas" data-name="back" accept=".png, .jpg, .jpeg"  required>
      <label for="back_item_file" class="card card--file-item custom-file-label">
        <span><i class="far fa-image"></i> <br>Foto de espaldas</span>
      </label>

      <div class="container-item-img"></div>

      @if ($errors->has('back_item_file'))
        <div class="invalid-validation mb-2">
          {{ $errors->first('back_item_file') }}
        </div>
      @else
        <div class="invalid-feedback mb-2">
          Selecciona la foto de la portada de la prenda.
        </div>
      @endif
    </div>

    <div class="col-sm-4 mb-5 thumb-size js-item-picture">
      <input type="file" name="selfie_item_file" id="selfie_item_file" class="no-file js-item-file custom-file-input" data-type="Selfie" accept=".png, .jpg, .jpeg"  data-name="selfie">
      <label for="selfie_item_file" class="card card--file-item custom-file-label">
        <span><i class="far fa-image"></i> <br>Selfie</span>
      </label>

      <div class="container-item-img"></div>

      @if ($errors->has('selfie_item_file'))
        <div class="invalid-validation mb-2">
          {{ $errors->first('selfie_item_file') }}
        </div>
      @endif
    </div>

    <div class="col-sm-4 mb-5 thumb-size js-item-picture">
      <input type="file" name="in_item_file" id="in_item_file" class="no-file js-item-file custom-file-input" data-type="Prenda puesta" accept=".png, .jpg, .jpeg"  data-name="in">
      <label for="in_item_file" class="card card--file-item custom-file-label">
        <span><i class="far fa-image"></i> <br>Prenda puesta</span>
      </label>

      <div class="container-item-img"></div>

      @if ($errors->has('in_item_file'))
        <div class="invalid-validation mb-2">
          {{ $errors->first('in_item_file') }}
        </div>
      @endif
    </div>

  </div>

</div>
@endif

<div class="form-group">
  <label for="ItemDescription">Descripción corta *</label>
  <textarea name="ItemDescription" id="ItemDescription" class="form-control js-text-limit" placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod..." rows="3" maxlength="256" data-limit="256" required>{{ $item ? $item->first()->ItemDescription : old('ItemDescription') }}</textarea>
    <small class="counter-text">256 caracteres.</small>

  @if ($errors->has('ItemDescription'))
    <div class="invalid-validation">
      {{ $errors->first('ItemDescription') }}
    </div>
  @else
    <div class="invalid-feedback">
      El campo de descripción corta es obligatorio.
    </div>
  @endif
</div>

<div class="form-row">
  <div class="form-group {{ $item ? 'w-100' : 'col-md-6' }}">
    <label for="DepartmentID">Departamento *</label>
    <select id="DepartmentID" class="form-control js-departments-select " name="DepartmentID"  data-size="false" required>
      <option value="" selected>- Seleccionar -</option>

        @foreach($departments as $department)
          <option value="{{ $department->DepartmentID }}"  {{ ($item && ($department->DepartmentID == $item->first()->DepartmentID) || old('DepartmentID'))  ? 'selected' : '' }} >
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
  <div class="form-group {{ $item ? 'w-100' : 'col-md-6' }}">
    <label for="CategoryID">Categoría *</label>
    <select id="CategoryID" class="form-control js-categories-select" name="CategoryID" required>
      <option value="" selected>- Seleccionar -</option>

          @foreach($categories as $category)
            <option value="{{ $category->CategoryID }}"  {{ ($item && ($category->CategoryID == $item->first()->CategoryID) || old('CategoryID'))  ? 'selected' : '' }} >
              {{ $category->CategoryName }}
            </option>
          @endforeach
    </select>
    <small>Ejemplo: Ropa, Calzado, Accesorios...</small>

    @if ($errors->has('CategoryID'))
      <div class="invalid-feedback">
        {{ $errors->first('CategoryID') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo categoría es obligatorio.
      </div>
    @endif
  </div>
</div>

<div class="form-row">
  <div class="form-group {{ $item ? 'w-100' : 'col-md-6' }}">
    <label for="BrandID">Marca *</label>

    <select id="BrandID" class="form-control js-brands-select" name="BrandID" value="{{ $item ? $item->first()->BrandID : '' }}"  data-size="false" required>
        <option value="" {{ !isset($otherBrand->OtherBrand) && !isset($item) ? 'selected' : '' }}>- Seleccionar -</option>

        @if(isset($brands))
          @foreach($brands as $brand)
            <option value="{{ $brand->BrandID }}" {{ $item && $item->first()->BrandID == $brand->BrandID || old('BrandID') ? 'selected' : '' }} >{{ $brand->BrandName }}</option>
          @endforeach
        @endif

        <option value="other" {{ isset($otherBrand->OtherBrand) ? 'selected' : '' }}> Otra marca</option>

    </select>

    <small>¿De qué marca es está prenda?</small>

    @if ($errors->has('BrandID'))
      <div class="invalid-feedback">
        {{ $errors->first('BrandID') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo marca es obligatorio.
      </div>
    @endif
  </div>

  <div class="form-group {{ $item ? 'w-100' : 'col-md-6' }} js-other {{ isset($otherBrand) ? '' : 'hidden' }}">
    <label for="otherBrand">Ingresa la marca *</label>
    <input type="text" class="form-control" name="otherBrand" id="otherBrand" value="{{ isset($otherBrand->OtherBrand) ? $otherBrand->OtherBrand : '' }}">
    <small>Lorem ipsum dolor sit amet</small>

    @if ($errors->has('otherBrand'))
      <div class="invalid-validation">
        {{ $errors->first('otherBrand') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo ingresa la marca es obligatorio.
      </div>
    @endif
  </div>

  <div class="form-group {{ $item ? 'w-100' : 'col-md-6' }} js-mean js-mean-clothing-type {{ isset($otherBrand) ? 'hidden' : '' }}">
    <label for="ClothingTypeID">Tipo de prenda *</label>
    <select id="ClothingTypeID" class="form-control js-clothing-type-select" name="ClothingTypeID" data-size="false" {{ !isset($otherBrand) ? 'required' : '' }}>
      <option value="" selected>- Seleccionar -</option>

      @if(isset($clothingTypes))
        @foreach($clothingTypes as $clothingType)
          <option value="{{ $clothingType->ClothingTypeID }}"  {{ ($item && ($clothingType->ClothingTypeID == $item->first()->ClothingTypeID) || old('ClothingTypeID'))  ? 'selected' : '' }} >
            {{ $clothingType->ClothingTypeName }}
          </option>
        @endforeach
      @endif
      <option value="other"> Otro tipo de prenda</option>

    </select>
    <small>Ejemplo: Blazer, Playera, Jeans...</small>

    @if ($errors->has('ClothingTypeID'))
        <div class="invalid-feedback">
          {{ $errors->first('ClothingTypeID') }}
        </div>
    @else
      <div class="invalid-feedback">
        El campo tipo de prenda es obligatorio.
      </div>
    @endif
  </div>
</div>

<div class="form-row js-other js-other-clothing-type {{ isset($otherBrand) ? '' : 'hidden' }}">
  <div class="form-group w-100">
    <label for="OtherClothingType">Ingresa el tipo de prenda *</label>
    <input type="text" class="form-control" name="OtherClothingType" id="OtherClothingType" value="{{ isset($otherBrand->OtherClothingType) ? $otherBrand->OtherClothingType : '' }}">
    <small>Lorem ipsum dolor sit amet</small>

    @if ($errors->has('OtherClothingType'))
      <div class="invalid-validation">
        {{ $errors->first('OtherClothingType') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo ingresa el tipo de prenda es obligatorio.
      </div>
    @endif
  </div>
</div>


<div class="form-row">
  <div class="form-group {{ $item ? 'w-100' : 'col-md-6' }} js-mean js-mean-size {{ isset($otherBrand) ? 'hidden' : '' }}">
    <label for="SizeID">Talla *</label>
    <select id="SizeID" class="form-control js-sizes-select" name="SizeID" {{ !isset($otherBrand) ? 'required' : '' }}>
      <option value="" selected>- Seleccionar -</option>

      @if(isset($sizes))
        @foreach($sizes as $size)
          <option value="{{ $size->SizeID }}"  {{ ($item && ($size->SizeID == $item->first()->SizeID) || old('SizeID'))  ? 'selected' : '' }} >
              {{ $size->SizeName }}
          </option>
        @endforeach
      @endif

      <option value="other"> Otro tipo de talla</option>
    </select>
    <small>¿Cuál es la talla de la prenda?</small>

      @if ($errors->has('SizeID'))
        <div class="invalid-feedback">
          {{ $errors->first('SizeID') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo talla es obligatorio.
        </div>
      @endif
  </div>

  <div class="form-group {{ $item ? 'w-100' : 'col-md-6' }} js-other js-other-size {{ isset($otherBrand) ? '' : 'hidden' }}">
    <label for="OtherSize">Ingresa la talla *</label>
    <input type="text" class="form-control" name="OtherSize" maxlength="8" id="OtherSize" value="{{ isset($otherBrand->OtherSize) ? $otherBrand->OtherSize : '' }}" >
    <small>Lorem ipsum dolor sit amet</small>

    @if ($errors->has('OtherSize'))
      <div class="invalid-validation">
        {{ $errors->first('OtherSize') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo ingresa la talla es obligatorio.
      </div>
    @endif
  </div>

  <div class="form-group {{ $item ? 'w-100' : 'col-md-6' }}">
    <label for="ClothingStyleID">Estilo *</label>
    <select id="ClothingStyleID" class="form-control" name="ClothingStyleID" required>
      <option value="" selected >- Seleccionar -</option>

        @foreach($styles as $style)
          <option value="{{ $style->ClothingStyleID }}"  {{ ($item && ($style->ClothingStyleID === $item->first()->ClothingStyleID) || old('ClothingStyleID'))  ? 'selected' : '' }} > {{ $style->ClothingStyleName }} </option>
        @endforeach
    </select>
    <small>Ejemplo: Casual, Formal, Deportiva</small>

    @if ($errors->has('ClothingStyleID'))
      <div class="invalid-feedback">
        {{ $errors->first('ClothingStyleID') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo estilo es obligatorio.
      </div>
    @endif
  </div>

</div>

<div class="form-row">
  <div class="form-group {{ $item ? 'w-100' : 'col-md-6' }}">
    <label for="ColorID">Color *</label>
    <select id="ColorID" class="form-control" name="ColorID" required>
      <option value="" selected >- Seleccionar -</option>

        @foreach($colors as $color)
          <option value="{{ $color->ColorID }}"  {{ ($item && ($color->ColorID === $item->first()->ColorID) || old('ColorID'))  ? 'selected' : '' }} > {{ $color->ColorName }} </option>
        @endforeach
    </select>
    <small>¿De qué color es la prenda?</small>

    @if ($errors->has('ColorID'))
      <div class="invalid-feedback">
        {{ $errors->first('ColorID') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo color es obligatorio.
      </div>
    @endif
  </div>
  <div class="form-group {{ $item ? 'w-100' : 'col-md-6' }}">
    <label for="TypeID">Condición de la prenda *</label>
    <select id="TypeID" class="form-control" name="TypeID" required>
      <option value="" selected>- Seleccionar -</option>

          @foreach($types as $type)
            <option value="{{ $type->TypeID }}"  {{ ($item && ($type->TypeID == $item->first()->TypeID) || old('TypeID'))  ? 'selected' : '' }} >
              {{ $type->TypeName }}
            </option>
          @endforeach
    </select>
    <small>Ejemplo: Nuevo con etiqueta...</small>

    @if ($errors->has('TypeID'))
      <div class="invalid-feedback">
        {{ $errors->first('TypeID') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo condición de la prenda es obligatorio.
      </div>
    @endif
  </div>
</div>

<div class="form-group">
    <label for="ClosetID">Colección</label>
    <select id="ClosetID" class="form-control" name="ClosetID" >
      <option value="" selected>- Seleccionar -</option>

      @if($closets->count() == 0)
        <option value="default" > Colección por defecto </option>
      @endif

      @foreach($closets as $closet)
        <option value="{{ $closet->ClosetID }}"  {{ ($item && ($closet->ClosetID == $item->first()->ClosetID) || old('ClosetID'))  ? 'selected' : '' }} >
          {{ $closet->ClosetName }}
        </option>
      @endforeach
    </select>
    <small>¿En qué colección se va a guardar está prenda?</small>

    @if ($errors->has('ClosetID'))
      <div class="invalid-feedback">
        {{ $errors->first('ClosetID') }}
      </div>
    @endif
  </div>

{{-- @if(!$item) --}}
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="OriginalPrice">Precio original *</label>
      <input type="number" class="form-control" name="OriginalPrice" id="OriginalPrice" value="{{ ($item) ? $item->first()->OriginalPrice : '' }}" required>
      <small>¿Cuánto te costo la prenda?</small>

      @if ($errors->has('OriginalPrice'))
        <div class="invalid-feedback">
          {{ $errors->first('OriginalPrice') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo precio original es obligatorio.
        </div>
      @endif
    </div>

    <div class="form-group col-md-6">
      <label for="ActualPrice">Precio actual *</label>

      <input type="number" class="form-control" name="ActualPrice" id="ActualPrice" value="{{ ($item) ? $item->first()->ActualPrice : '' }}" required>
      <small>¿En cuánto venderás la prenda?</small>

      @if($errors->first('ActualPrice'))
        <div class="invalid-feedback d-block">

          {{ $errors->first('ActualPrice') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo precio actual es obligatorio.
        </div>
      @endif
    </div>
  </div>
{{-- @endif  --}}
<div class="form-group">
  <div class="form-check mt-2">
    <input class="form-check-input js-check-offer" type="checkbox" id="offer" name="offer"  value="true" {{ $item && $item->first()->OffSaleID !== null || old('offer') ? 'checked' : '' }} >
    <label class="form-check-label" for="offer">¿Te gustaría agregar una oferta a la prenda?
    </label>
  </div>
</div>

<div class="card mb-4 js-check-container {{ $item && $item->first()->OffSaleID !== null || old('offer') ? '' : 'hidden' }}">
  <div class="card-body">
    <div class="form-group">
      <label for="Discount">Descuento *</label>
      <input type="number" class="form-control" name="Discount" id="Discount" min="1" max="99" value="{{ $item && $item->first()->OffSaleID !== null ? $offers[$item->first()->OffSaleID][0]->Discount : old('Discount') }}"  onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='1';}">
      <small>Escribe el porcentaje de descuento que le deseas aplicar a la prenda.</small>

      @if ($errors->has('Discount'))
        <div class="invalid-validation d-block">
          {{ $errors->first('Discount') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo descuento es obligatorio.
        </div>
      @endif
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="ValidFrom">Desde *</label>
        <input type="text" class="form-control date_input" name="ValidFrom" id="ValidFrom" value="{{ isset($ValidFrom) && $ValidFrom !== '' ? $ValidFrom : (old('ValidFrom') ? old('ValidFrom') : '') }}" placeholder="dd/mm/aaaa" autocomplete="off">
        <small>Selecciona la fecha inicial de la oferta.</small>

        @if ($errors->has('ValidFrom'))
          <div class="invalid-validation">
            {{ $errors->first('ValidFrom') }}
          </div>
        @else
          <div class="invalid-feedback">
            El campo desde es obligatorio.
          </div>
        @endif
      </div>

      <div class="form-group col-md-6">
        <label for="ValidUntil">Hasta *</label>
        <input type="text" class="form-control date_input" name="ValidUntil" id="ValidUntil" value="{{ isset($ValidUntil) && $ValidUntil !== '' ? $ValidUntil : (old('ValidUntil') ? old('ValidUntil') : '') }}" placeholder="dd/mm/aaaa" autocomplete="off">

        <small>Selecciona la fecha final de la oferta.</small>

        @if ($errors->has('ValidUntil'))
          <div class="invalid-validation">
            {{ $errors->first('ValidUntil') }}
          </div>
        @else
          <div class="invalid-feedback">
            El campo hasta es obligatorio.
          </div>
        @endif
      </div>
    </div>
  </div>
</div>