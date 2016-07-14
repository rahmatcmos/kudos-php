@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1>{{ trans('customers.customers') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          <a href="/customers/create" class="btn btn-success">{{ trans('crud.create') }}</a>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>{{ trans('customers.name') }}</th>
            <th>{{ trans('customers.email') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($customers as $customer)
          <tr>
            <td><a href="/customers/{{ $customer->id }}/edit">{{ $customer->first_name }} {{ $customer->last_name }}</a></td>
            <td><a href="/customers/{{ $customer->id }}/edit">{{ $customer->email }}</a></td>
          </tr>    
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
    
@endsection
