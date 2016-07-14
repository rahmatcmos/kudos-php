@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1>{{ trans('blog.blog') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          <a href="/admin/blog/create" class="btn btn-success">{{ trans('crud.create') }}</a>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>{{ trans('blog.name') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($blog as $blog)
          <tr>
            <td><a href="/admin/blog/{{ $blog->id }}/edit">{{ isset($blog->$language['name']) ? $blog->$language['name'] : $blog->default['name'] }}</a></td>
          </tr>    
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
    
@endsection