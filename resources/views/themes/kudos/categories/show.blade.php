@extends('themes.kudos.layouts.app')

@section('crumbs')
<ul>
  <li><a href="/" title="{{ trans('nav.home') }}">{{ trans('nav.home') }}</a> &raquo;</li>
  <li><a href="/categories/{{ $category->slug }}" title="{{ $category->name }}">{{ $category->name }}</a></li>
  <li class="pull-right">
    <form class="form-inline ordering" action="/products/filter" method="post">
      {{ csrf_field() }}
      <select name="order_by" class="form-control">
        <option value="created_at" {{ session('product.order_by')=='created_at' ? 'selected' : '' }}>Date</option>
        <option value="price" {{ session('product.order_by')=='price' ? 'selected' : '' }}>Price</option>
      </select>
      <select name="order_dir" class="form-control">
        <option value="desc" {{ session('product.order_dir')=='desc' ? 'selected' : '' }}>Descending</option>
        <option value="asc" {{ session('product.order_dir')=='asc' ? 'selected' : '' }}>Ascending</option>
      </select>
    </form>
  </li>
</ul> 
@endsection

@section('content')
@if(!$products->count())
  <div class="alert alert-info" role="alert">{{ trans('search.none') }}</div>
@endif
<ul class="row results">
  @foreach ($products as $product)
    <li class="col-md-2 text-center">
      <a href="/products/{{ $product->slug }}"><img src="/storage/{{ str_replace('/thumb/', '/medium/', $product->defaultImage) }}" class="img-responsive"></a>
      <h2><a href="/products/{{ $product->slug }}">{{ $product->name }}</a></h2>
      @if(!empty($product->salePrice))
      <p class="price"><i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ $product->salePrice }}</p>
      @else
      <p class="price"><i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ $product->price }}</p>
      @endif
    </li>
  @endforeach
</ul>
<div id="paginate" data-page="{{ $products->currentPage()+1 }}" data-limit="{{ $products->perPage() }}" data-count="{{ $products->count() }}" data-complete="false"></div>
@endsection