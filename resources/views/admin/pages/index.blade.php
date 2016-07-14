@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1>{{ trans('pages.pages') }}</h1>
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
            <th>{{ trans('pages.name') }}</th>
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
    </div>
  </section>
    
@endsection