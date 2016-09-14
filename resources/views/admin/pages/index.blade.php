@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1>
            {{ ($pages->currentPage()-1) * $pages->perPage() + 1 }}
            to
            {{ min($pages->total(), $pages->currentPage() * $pages->perPage()) }}
            of 
            {{ $pages->total() }}
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
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              <a href="/admin/pages?page={{ $pages->currentPage() }}&order_by=name&order_dir={{ session('page.order_dir') == 'asc' ? 'desc' : 'asc' }}" 
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
      {{ $pages->appends(['order_by' => session('page.order_by'), 'order_dir' => session('page.order_dir')] )->links() }}
    </div>
  </section>
    
@endsection