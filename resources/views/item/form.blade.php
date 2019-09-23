@csrf

@if(!$item)
  @include('alerts.success')
  @include('alerts.warning')
@endif

@include('item.partials.files')
@include('item.partials.description')

<div class="form-row">
  @include('item.partials.department')
  @include('item.partials.category')
</div>

 <div class="form-row">
  @include('item.partials.brand')
  @include('item.partials.clothing-type')
  @include('item.partials.other-brand')
</div>

<div class="form-row">
  @include('item.partials.size')
  @include('item.partials.color')
</div>

<div class="form-row">
  @include('item.partials.condition')
  @include('item.partials.collection')
</div>


@include('item.partials.price')
@include('item.partials.offer')

