<option value="{{ $cat['_id'] }}" 
  {{ isset($shop->root) && $shop->root==$cat['_id'] ? 'selected' : '' }}>
  {{ isset($cat[$language]['name']) ? $cat[$language]['name'] : $cat['default']['name'] }}
</option>
@if( isset($cat['children']))
  @foreach ($cat['children'] as $cat)
    @include('admin.shops.partials.option', ['cat' => $cat])
  @endforeach
@endif
