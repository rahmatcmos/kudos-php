@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1>
            @if($pages->total()>0)
              {{ ($pages->currentPage()-1) * $pages->perPage() + 1 }}
              to
              {{ min($pages->total(), $pages->currentPage() * $pages->perPage()) }}
              of 
              {{ $pages->total() }}
            @endif
            {{ trans('pages.pages') }}
          </h1>
        </div>
        <div class="col-md-3 text-right">
          <a href="/admin/pages/create" class="btn btn-success">{{ trans('crud.create') }}</a>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      {{ Form::open(['method' => 'get', 'url' => 'admin/pages']) }}
        {{ Form::text('search', '', ['class' => 'form-control', 'placeholder' => trans('search.search').'...']) }}
      {{ Form::close() }}
      @if( $pages->search )
        <p class="clear-search"><a href="/admin/pages" class="btn btn-red">clear search for "{{ $pages->search }}"</a></p>
      @endif
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              <a href="/admin/pages?page={{ $pages->currentPage() }}&order_by=name&order_dir={{ session('page.order_dir') == 'asc' ? 'desc' : 'asc' }}&search={{ $pages->search }}" 
                class="order-{{ session('page.order_by') == 'name' ? session('page.order_dir') : '' }}">
                {{ trans('pages.name') }}
              </a>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pages as $page)
          <tr>
            <td><a href="/admin/pages/{{ $page->id }}/edit">{{ isset($page->$language['name']) ? $page->$language['name'] : $page->default['name'] }}</a></td>
          </tr>    
          @endforeach
        </tbody>
      </table>
      {{ $pages->appends(['search' => $pages->search, 'order_by' => session('page.order_by'), 'order_dir' => session('page.order_dir')] )->links() }}
    </div>
  </section>
    
@endsection