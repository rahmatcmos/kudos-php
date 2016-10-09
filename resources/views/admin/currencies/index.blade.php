@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1>{{ trans('currencies.currencies') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          <a href="/admin/currencies/auto" class="btn btn-info">Automatically update <i class="fa fa-refresh"></i></a> <a href="/admin/currencies/create" class="btn btn-success">{{ trans('crud.create') }}</a>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <p>{{ trans('currencies.autoinfo') }} <code>php artisan update:currencies</code></p>
      <hr>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>{{ trans('currencies.currency') }}</th>
            <th>{{ trans('currencies.rate') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($currencies as $currency)
          <tr>
            <td><a href="/admin/currencies/{{ $currency->id }}/edit">{{ $currency->currency }}</a></td>
            <td><a href="/admin/currencies/{{ $currency->id }}/edit">{{ $currency->rate }}</a></td>
          </tr>    
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
    
@endsection
