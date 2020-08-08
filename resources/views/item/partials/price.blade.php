  <commission-component
    actual="{{ old('ActualPrice') ? old('ActualPrice') : ($item && $item->ActualPrice ? $item->ActualPrice  : '' ) }}"
    original="{{ old('OriginalPrice') ? old('OriginalPrice') : ($item && $item->OriginalPrice ? $item->OriginalPrice  : '' ) }}"
    :commission="{{ $commission }}"
    :errors="{{ $errors }}"
  ></commission-component>