<li id="id_{{ $category['_id'] }}">
  <div>
    <a href="/admin/categories/{{ $category['_id'] }}/edit">{{ isset($category[$language]['name']) ? $category[$language]['name'] : $category['default']['name'] }}</a>
  </div>
@if( isset($category['children']))
  <ol>
  @foreach ($category['children'] as $category)
    @include('admin.categories.partials.item', ['category' => $category])
  @endforeach
  </ol>
@endif
</li>