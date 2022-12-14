
 <div class="mb-2">
  <div class="d-flex justify-content-between">
    <label>Coloca abajo las mejores fotos de la prenda a vender *</label>
    <span>
      <a href="{{ url('support') }}" class="btn-tooltip" target="_blank">
        <i class="far fa-question-circle"></i>
        <span class="btn-tooltip__text">¿Cómo tomar mejores fotos?</span>
      </a> 
    </span>
  </div>
    <div class="js-items-container d-flex flex-wrap justify-content-center justify-content-sm-between mt-2">

      <div class="mb-5 thumb-size js-item-picture">

        @if($front)
          <div class="container-item-img card">
            <a  href="{{ url('item/'.$front->ItemPictureID.'/'.$front->ItemID.'/delete') }}" class="close delete-item js-delete-item" aria-label="Close" data-type="Foto frontal" data-name="front" data-item="true">
              <i class="far fa-trash-alt"></i>
            </a>
            <img src="{{ url('storage/'.$front->ThumbPath) }}" style="width: 200px;">

            <div class="form-check cover-item">
              <input class="form-check-input" type="radio" name="cover" id="cover_front" value="front" {{ ($front->IsCover == 1 ? 'checked' : '') }}>
              <label class="form-check-label" for="cover_front">
                <span>
                  Portada
                </span>
              </label>
            </div>
          </div>

        @else

          <input 
            type="file" 
            value="{{ old('front_item_file') ? old('front_item_file') : false }}" 
            name="front_item_file" 
            id="front_item_file" 
            class="no-file js-item-file custom-file-input" 
            data-type="Foto frontal" 
            data-name="front"
            data-item="true" 
            ref="front"
            accept=".png, .jpg, .jpeg"
            ref="front"
            {{ $count ? '' : ($front ? '' : 'required') }}
           >
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
              Foto frontal de la prenda.
            </div>         
          @endif

        @endif
        
      </div>

      <div class="mb-5 thumb-size js-item-picture">

      @if($label)
          <div class="container-item-img card">
            <a href="{{ url('item/'.$label->ItemPictureID.'/'.$label->ItemID.'/delete') }}" class="close delete-item js-delete-item" aria-label="Close" data-type="Foto frontal" data-name="label" data-item="true">
              <i class="far fa-trash-alt"></i>
            </a>
            <img src="{{ url('storage/'.$label->ThumbPath) }}" style="width: 200px;">

            <div class="form-check cover-item">
              <input class="form-check-input" type="radio" name="cover" id="cover_label" value="label" {{ $label->IsCover == 1 ? 'checked' : '' }}>
              <label class="form-check-label" for="cover_label">
              <span>
                  Portada
                </span>
              </label>
            </div>
          </div>

      @else
        <input 
          type="file" 
          name="label_item_file" 
          id="label_item_file" 
          class="no-file js-item-file custom-file-input" 
          data-type="Foto de la etiqueta" 
          data-name="label" 
          data-item="true" 
          accept=".png, .jpg, .jpeg"
          ref="label"
          {{ $count ? '' : ($label ? '' : 'required') }}>
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
            Foto de la etiqueta de la prenda.
          </div> 
        @endif
      @endif
      </div>

      <div class="mb-5 thumb-size js-item-picture">

      @if($back)
          <div class="container-item-img card">
            <a  href="{{ url('item/'.$back->ItemPictureID.'/'.$back->ItemID.'/delete') }}" class="close delete-item js-delete-item" aria-label="Close" data-type="Foto de espaldas" data-name="back" data-item="true">
              <i class="far fa-trash-alt"></i>
            </a>
            <img src="{{ url('storage/'.$back->ThumbPath) }}" style="width: 200px;">

            <div class="form-check cover-item">
              <input class="form-check-input" type="radio" name="cover" id="cover_back" value="back" {{ $back->IsCover == 1 ? 'checked' : '' }}>
              <label class="form-check-label" for="cover_back">
              <span>
                  Portada
                </span>
              </label>
            </div>
          </div>

      @else
        <input 
          type="file" 
          name="back_item_file" 
          id="back_item_file" 
          class="no-file js-item-file custom-file-input" 
          data-type="Foto de espaldas" 
          data-name="back" 
          data-item="true" 
          accept=".png, .jpg, .jpeg"
          ref="back"
          {{ $count ? '' : ($back ? '' : 'required') }}>
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
            Foto de espaldas de la prenda.
          </div> 
        @endif
      @endif 
      </div>

      <div class="mb-5 thumb-size js-item-picture">
      @if($selfie)
          <div class="container-item-img card">
            <a  href="{{ url('item/'.$selfie->ItemPictureID.'/'.$selfie->ItemID.'/delete') }}" class="close delete-item js-delete-item" aria-label="Close" data-type="Selfie" data-name="selfie" data-item="true">
              <i class="far fa-trash-alt"></i>
            </a>
            <img src="{{ url('storage/'.$selfie->ThumbPath) }}" style="width: 200px;">

            <div class="form-check cover-item">
              <input class="form-check-input" type="radio" name="cover" id="cover_selfie" value="selfie" {{ $selfie->IsCover == 1 ? 'checked' : '' }}>
              <label class="form-check-label" for="cover_selfie">
              Selfie
              </label>
            </div>
          </div>

      @else
        <input 
          type="file" 
          name="selfie_item_file" 
          id="selfie_item_file" 
          class="no-file js-item-file custom-file-input" 
          data-type="Selfie" 
          accept=".png, .jpg, .jpeg"  
          data-name="selfie" 
          data-item="true"
          ref="selfie"
          >
        <label for="selfie_item_file" class="card card--file-item custom-file-label">
          <span><i class="far fa-image"></i> <br>Selfie</span>
        </label>

        <div class="container-item-img"></div>

        @if ($errors->has('selfie_item_file'))
          <div class="invalid-validation mb-2">
            {{ $errors->first('selfie_item_file') }}
          </div>
        @else
          <div class="invalid-feedback mb-2">
            Selfie de la prenda.
          </div> 
        @endif
      @endif
      </div>

      <div class="mb-5 thumb-size js-item-picture">
      @if($in)
          <div class="container-item-img card">
            <a  href="{{ url('item/'.$in->ItemPictureID.'/'.$in->ItemID.'/delete') }}" class="close delete-item js-delete-item" aria-label="Close" data-type="Prenda puesta" data-name="in" data-item="true">
              <i class="far fa-trash-alt"></i>
            </a>
            <img src="{{ url('storage/'.$in->ThumbPath) }}" style="width: 200px;">

            <div class="form-check cover-item">
              <input class="form-check-input" type="radio" name="cover" id="cover_in" value="in" {{ $in->IsCover == 1 ? 'checked' : '' }}>
              <label class="form-check-label" for="cover_in">
              <span>
                  Portada
                </span>
              </label>
            </div>
          </div>

      @else

        <input 
          type="file" 
          name="in_item_file" 
          id="in_item_file" 
          class="no-file js-item-file custom-file-input" 
          data-type="Prenda puesta" 
          accept=".png, .jpg, .jpeg"
          data-name="in" 
          data-item="true"
          ref="in"
          >
        <label for="in_item_file" class="card card--file-item custom-file-label">
          <span><i class="far fa-image"></i> <br>Prenda puesta</span>
        </label>

        <div class="container-item-img"></div>

        @if ($errors->has('in_item_file'))
          <div class="invalid-validation mb-2">
            {{ $errors->first('in_item_file') }}
          </div>
        @else
          <div class="invalid-feedback mb-2">
            Foto con la prenda puesta.
          </div> 
        @endif
      @endif
      </div>

      <div class="mb-4 thumb-size js-item-picture">
      @if($extra)
          <div class="container-item-img card">
            <a  href="{{ url('item/'.$extra->ItemPictureID.'/'.$extra->ItemID.'/delete') }}" class="close delete-item js-delete-item" aria-label="Close" data-type="Foto extra" data-name="extra" data-item="true">
              <i class="far fa-trash-alt"></i>
            </a>
            <img src="{{ url('storage/'.$extra->ThumbPath) }}" style="width: 200px;">

            <div class="form-check cover-item">
              <input class="form-check-input" type="radio" name="cover" id="cover_extra" value="extra" {{ $extra->IsCover == 1 ? 'checked' : '' }}>
              <label class="form-check-label" for="cover_extra">
              <span>
                  Portada
                </span>
              </label>
            </div>
          </div>

      @else
        <input 
          type="file" 
          name="extra_item_file" 
          id="extra_item_file" 
          class="no-file js-item-file custom-file-input" 
          data-type="Foto extra" 
          data-name="extra" 
          data-item="true" 
          accept=".png, .jpg, .jpeg"
          ref="extra"
          >
        <label for="extra_item_file" class="card card--file-item custom-file-label">
          <span><i class="far fa-image"></i> <br>Foto extra</span>
        </label>

        <div class="container-item-img"></div>

        @if ($errors->has('extra_item_file'))
          <div class="invalid-validation mb-2">
            {{ $errors->first('extra_item_file') }}
          </div>
        @else
          <div class="invalid-feedback mb-2">
            Selecciona la foto extra de la prenda.
          </div>
        @endif
      @endif
      </div>
      </div>  

</div>