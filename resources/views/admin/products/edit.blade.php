@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1><a href="/admin/products">{{ trans('products.products') }}</a> > {{ trans('crud.edit') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          {{ Form::open(['url' => 'admin/products/' . $product->id]) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit(trans('crud.delete'), ['class' => 'btn btn-danger']) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <!-- if there are creation errors, they will show here -->
      {{ Html::ul($errors->all()) }}
      {{ Form::model($product, ['url' => 'admin/products/'.$product->id, 'method' => 'PUT']) }}
        {{ Form::hidden('shop_id', session('shop')) }}
        {{ Form::label('name', trans('products.name')) }}
        {{ Form::text('name', isset($product->$language['name']) ? $product->$language['name'] : $product->default['name'], ['class' => 'form-control']) }}
        {{ Form::label('categories', trans('categories.category')) }}
        {{ Form::select('categories', $categories, $product->category_id,  ['class' => 'form-control','multiple'=>'multiple','name'=>'categories[]']) }}
        {{ Form::submit(trans('crud.edit'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
