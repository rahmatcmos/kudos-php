@extends('themes.Basic.layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <img src="/uploads/{{ str_replace('/thumb/', '/', $product->defaultImage) }}" class="img-responsive">
    </div>
    <div class="col-md-6">
      <h2>{{ isset($product->$language['name']) ? $product->$language['name'] : $product->default['name'] }}</h2>
      <p>{{ isset($product->$language['excerpt']) ? $product->$language['excerpt'] : $product->default['excerpt'] }}</p>
      {!! isset($product->rrp) ? '<p>RRP: &pound;'.$product->rrp.'</p>' : '' !!}
      <p>Price: &pound;{!! isset($product->salePrice) ? '<strike>'.$product->price.'</strike> &pound;'.$product->salePrice : $product->price !!}</p>
      {{ Form::open(['url' => 'basket']) }}
        {{ Form::hidden('id',  $product['id']) }}
        {{ Form::hidden('price',  isset($product->salePrice) ? $product->salePrice : $product->price) }}
        {{ Form::submit('Add to Basket', ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </div>
  <hr>
  <h3>Product Details</h3>
  {!! isset($product->$language['content']) ? $product->$language['content'] : $product->default['content'] !!}
@endsection
