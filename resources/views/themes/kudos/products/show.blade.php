@extends('themes.kudos.layouts.app')

@section('crumbs')
<ul class="container">
  <li><a href="/" title="{{ trans('nav.home') }}">{{ trans('nav.home') }}</a> &raquo;</li>
  <li><a href="/products/{{ $product->slug }}" title="{{ $product->name }}">{{ $product->name }}</a></li>
</ul> 
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6 images">
      <a href="/storage/{{ str_replace('/large/', '/', $product->defaultImage) }}" class="trigger-thumb"><img src="/storage/{{ $product->defaultImage }}" class="img-responsive main"></a>
      <ul class="row thumbs">
      @foreach($product->files as $thumb)
        <li class="col-md-4">
          <a href="/storage/{{ str_replace('/thumb/', '/', $thumb ) }}" class="swipebox"><img src="/storage/{{ $thumb }}" class="img-responsive"></a>
        </li>
      @endforeach
      </ul>
    </div>
    <div class="col-md-6">
      <h1>{{ $product->name }}</h1>
      <p id="excerpt">{{ $product->excerpt }}</p>
      <div id="price">
        @if(!empty($product->rrp) && $product->rrp > 0)
        <p>rrp: <strong><i class="fa fa-{{ strtolower(session('currency')) }}"></i><strike>{{ $product->rrp }}</strike></strong></p>
        @endif
        @if(!empty($product->salePrice) && $product->salePrice > 0)
        <p>was: <strong><i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ $product->price }}</strong></p>
        <p class="price">now: <strong><i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ $product->salePrice }}</strong></p>
        @else
        <p class="price">price: <strong><i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ $product->price }}</strong></p>
        @endif
      </div>
      {{ Form::open(['url' => 'basket', 'id' => 'add-to-basket']) }}
      
        <!-- product options -->
        @php
          $options = isset($product->options[$language]) ? $product->options[$language] : $product->options['default'] ;
          ksort($options) ;
        @endphp
        @if($options)
          @foreach($options as $key => $option)
            {{ Form::label($key, key($option)) }}
            {{ Form::select($key, $option[key($option)], '', ['class' => 'form-control']) }}
          @endforeach
        @endif
        <!-- /product options -->
      
        {{ Form::hidden('id',  $product['id']) }}
        {{ Form::hidden('price',  !empty($product->salePrice) ? $product->salePrice : $product->price) }}
        @php $range = range(0,10) ; unset($range[0]) @endphp
        {{ Form::label('qty', trans('basket.quantity')) }}
        {{ Form::select('qty', $range, 1, ['class' => 'form-control']) }}
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
