<option value="{{ $cat['_id'] }}" 
  {{ isset($category->parent) && $category->parent==$cat['_id'] ? 'selected' : '' }} 
  {{ isset($category['_id']) && $category['_id']==$cat['_id'] ? ' disabled' : '' }}>
  {{ isset($cat[$language]['name']) ? $cat[$language]['name'] : $cat['default']['name'] }}
</option>
@if( isset($cat['children']))
  @foreach ($cat['children'] as $cat)
    @include('admin.categories.partials.option', ['cat' => $cat])
  @endforeach
@endif
