@extends('themes.kudos.layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6 images">
      <a href="/storage/{{ str_replace('/large/', '/', $product->defaultImage) }}" target="_blank"><img src="/storage/{{ $product->defaultImage }}" class="img-responsive main"></a>
      <ul class="row">
      @foreach($product->files as $thumb)
        <li class="col-md-4">
          <a href="/storage/{{ str_replace('/thumb/', '/', $thumb ) }}" target="_blank"><img src="/storage/{{ $thumb }}" class="img-responsive"></a>
        </li>
      @endforeach
      </ul>
    </div>
    <div class="col-md-6">
      <h1>{{ $product->name }}</h1>
      <p id="excerpt">{{ $product->excerpt }}</p>
      <div id="price">
        @if(!empty($product->rrp))
        <p>rrp: <strong><i class="fa fa-{{ strtolower(session('currency')) }}"></i><strike>{{ $product->rrp }}</strike></strong></p>
        @endif
        @if(!empty($product->salePrice))
        <p>was: <strong><i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ $product->price }}</strong></p>
        <p class="price">now: <strong><i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ $product->salePrice }}</strong></p>
        @else
        <p class="price">price: <strong><i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ $product->price }}</strong></p>
        @endif
      </div>
      {{ Form::open(['url' => 'basket']) }}
        {{ Form::hidden('id',  $product['id']) }}
        {{ Form::hidden('price',  !empty($product->salePrice) ? $product->salePrice : $product->price) }}
        {{ Form::submit('Add to Basket', ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </div>
  <hr>
  <h3>Product Details</h3>
  <div class="content">
    {!! $product->content !!}
  </div>
</div>
@endsection
