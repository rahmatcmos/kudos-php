@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1>{{ trans('products.products') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          <a href="/admin/products/create" class="btn btn-success">{{ trans('crud.create') }}</a>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>{{ trans('products.name') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
          <tr>
            <td><a href="/admin/products/{{ $product->id }}/edit">{{ isset($product->$language['name']) ? $product->$language['name'] : $product->default['name'] }}</a></td>
          </tr>    
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
    
@endsection
