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
      @if($product->defaultImage)
      <a href="/storage/{{ str_replace('/large/', '/', $product->defaultImage) }}" class="trigger-thumb"><img src="/storage/{{ $product->defaultImage }}" class="img-responsive main"></a>
      @endif
      <ul class="row thumbs">
      @foreach($product->files as $thumb)
        <li class="col-xs-4">
          <a href="/storage/{{ str_replace('/thumb/', '/', $thumb ) }}" class="swipebox"><img src="/storage/{{ $thumb }}" class="img-responsive"></a>
        </li>
      @endforeach
      </ul>
    </div>
    <div class="col-md-6">
      <h1>{{ $product->name }}</h1>
      <small>{{ trans('products.sku') }}: <span id="sku">{{ $product->sku }}</span></small>
      <p id="excerpt">{{ $product->excerpt }}</p>
      <div id="price">
        @if(isset($product->first['price']))
          <p class="price">price: <strong><i class="fa fa-{{ strtolower(session('currency')) }}"></i><span id="price-tag">{{ $product->first['price'] }}</span></strong></p>
        @else
          @if(!empty($product->rrp) && $product->rrp > 0)
          <p>rrp: <strong><i class="fa fa-{{ strtolower(session('currency')) }}"></i><strike>{{ $product->rrp }}</strike></strong></p>
          @endif
          @if(!empty($product->salePrice) && $product->salePrice > 0)
          <p>was: <strong><i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ $product->price }}</strong></p>
          <p class="price">now: <strong><i class="fa fa-{{ strtolower(session('currency')) }}"></i><span id="price-tag">{{ $product->salePrice }}</span></strong></p>
          @else
          <p class="price">price: <strong><i class="fa fa-{{ strtolower(session('currency')) }}"></i><span id="price-tag">{{ $product->price }}</span></strong></p>
          @endif
        @endif
      </div>
      {{ Form::open(['url' => 'basket', 'id' => 'add-to-basket']) }}
      
        <!-- product options -->
        @if($product->options && $product->option_values)
            <div id="product-options">
            @foreach($product->options as $option)
              @php 
                $options = isset($option[$language]) ? $option[$language] : $option['default'] ;
              @endphp
              @foreach($options as $key => $opt)
                {{ Form::label($option->id, key($options)) }}
                <select name="{{ $option->id }}" class="form-control">
                  @foreach($opt as $id => $name)
                    @if(in_array($id, array_keys($available[$option->id])))
                    <option value="{{ $id }}" {{ $id==$product->first['options'][$option->id] ? 'selected' : '' }}>{{ $name }}</option>
                    @endif
                  @endforeach
                </select>
              @endforeach
            @endforeach
            </div>
        @endif
        <!-- /product options -->
      
        {{ Form::hidden('id', $product['id']) }}
        {{ Form::hidden('sku', $product['sku']) }}
        {{ Form::hidden('parent_sku', $product->sku) }}
        {{ Form::hidden('price', 
          isset($product->first['price']) 
            ? $product->first['price'] 
            : !empty($product->salePrice) 
              ? $product->salePrice 
              : $product->price)
        }}
        
        @php $range = range(0,10) ; unset($range[0]) @endphp
        {{ Form::label('qty', trans('basket.quantity')) }}
        {{ Form::select('qty', $range, 1, ['class' => 'form-control']) }}
        {{ Form::submit('Add to Basket', ['class' => 'btn btn-primary', 'id' => 'add-to-cart']) }}
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