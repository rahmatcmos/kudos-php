@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1>{{ trans('users.users') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          <a href="/admin/users/create" class="btn btn-success">{{ trans('crud.create') }}</a>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>{{ trans('users.name') }}</th>
            <th>{{ trans('users.email') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td><a href="/admin/users/{{ $user->id }}/edit">{{ $user->name }}</a></td>
            <td><a href="/admin/users/{{ $user->id }}/edit">{{ $user->email }}</a></td>
          </tr>    
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
    
@endsection
