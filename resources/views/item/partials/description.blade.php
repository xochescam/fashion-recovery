<div class="form-group">
  <label for="ItemDescription">Descripción corta *</label>
  <textarea name="ItemDescription" id="ItemDescription" class="form-control js-text-limit" placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod..." rows="3" maxlength="256" data-limit="256" required>
    {{ old('ItemDescription') ? old('ItemDescription') : ($item  ? $item->ItemDescription : '') }}
  </textarea>
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