@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1>{{ trans('shops.shops') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          <a href="/admin/shops/create" class="btn btn-success">{{ trans('crud.create') }}</a>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>{{ trans('shops.name') }}</th>
            <th>{{ trans('shops.code') }}</th>
            <th>{{ trans('fields.url') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($shops as $shop)
          <tr>
            <td><a href="/admin/shops/{{ $shop->id }}/edit">{{ isset($shop->$language['name']) ? $shop->$language['name'] : $shop->default['name'] }}</a></td>
            <td><a href="{{ $shop->code }}">{{ $shop->code }}</a></td>
            <td><a href="{{ $shop->url }}" target="_blank">{{ $shop->url }}</a></td>
          </tr>    
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
    
@endsection
