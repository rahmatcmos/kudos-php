@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1>{{ trans('categories.categories') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          <a href="/admin/categories/create" class="btn btn-success">{{ trans('crud.create') }}</a>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <ol class="sortable">
      @foreach ($categories as $category)
        @include('admin.categories.partials.item', ['category' => $category])
      @endforeach
      </ol>
    </div>
  </section>
@endsection

@section('foot')
    <script>
    $(function() {
      $('.sortable').nestedSortable({
  			handle: 'div',
  			items: 'li',
  			toleranceElement: '> div',
  			stop: function( event, ui ) {
          $.post(
            '/admin/categories/save-order', 
            {'_token': '{!! csrf_token() !!}', 'categories': $( ".sortable" ).sortable( "toArray")}
          );
  			}
  		});
    });
  </script>
@endsection