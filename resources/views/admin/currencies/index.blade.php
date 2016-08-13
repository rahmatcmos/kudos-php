@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1>{{ trans('currencies.currencies') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          <a href="#" class="btn btn-info">Automatically update <i class="fa fa-refresh"></i></a> <a href="/admin/currencies/create" class="btn btn-success">{{ trans('crud.create') }}</a>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <p>Whilst you can manually update currency data it is recommended that you automatically fill currency rates.</p>
      <p>If you wish to automatically update currency rates you should set a cron to <a href="#">http:///currencies/automatic</a></p>
      <hr>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>{{ trans('currencies.code') }}</th>
            <th>{{ trans('currencies.currency') }}</th>
            <th>{{ trans('currencies.rate') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($currencies as $currency)
          <tr>
            <td><a href="/admin/currencies/{{ $currency->id }}/edit">{{ $currency->code }}</a></td>
            <td><a href="/admin/currencies/{{ $currency->id }}/edit">{{ $currency->currency }}</a></td>
            <td><a href="/admin/currencies/{{ $currency->id }}/edit">{{ $currency->rate }}</a></td>
          </tr>    
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
    
@endsection
