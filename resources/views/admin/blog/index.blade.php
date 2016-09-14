@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1>
            {{ ($blog->currentPage()-1) * $blog->perPage() + 1 }}
            to
            {{ min($blog->total(), $blog->currentPage() * $blog->perPage()) }}
            of 
            {{ $blog->total() }}
            {{ trans('blog.articles') }}
          </h1>
        </div>
        <div class="col-md-3 text-right">
          <a href="/admin/blog/create" class="btn btn-success">{{ trans('crud.create') }}</a>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      {{ Form::open(['method' => 'get', 'url' => 'admin/blog']) }}
        {{ Form::text('search', '', ['class' => 'form-control', 'placeholder' => trans('search.search').'...']) }}
      {{ Form::close() }}
      @if( $blog->search )
        <p class="clear-search"><a href="/admin/blog" class="btn btn-red">clear search for "{{ $blog->search }}"</a></p>
      @endif
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              <a href="/admin/blog?page={{ $blog->currentPage() }}&order_by=name&order_dir={{ session('blog.order_dir') == 'asc' ? 'desc' : 'asc' }}&search={{ $blog->search }}" 
                class="order-{{ session('blog.order_by') == 'name' ? session('blog.order_dir') : '' }}">
              {{ trans('blog.name') }}
              </a>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($blog as $article)
          <tr>
            <td><a href="/admin/blog/{{ $article->id }}/edit">{{ isset($article->$language['name']) ? $article->$language['name'] : $article->default['name'] }}</a></td>
          </tr>    
          @endforeach
        </tbody>
      </table>
      {{ $blog->appends(['search' => $blog->search, 'order_by' => session('blog.order_by'), 'order_dir' => session('blog.order_dir')] )->links() }}
    </div>
  </section>
    
@endsection