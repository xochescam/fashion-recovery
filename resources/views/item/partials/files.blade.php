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