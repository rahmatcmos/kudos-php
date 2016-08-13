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
      <div class="row">
        <div class="col-md-4">
          {{ Form::label('images', trans('fields.images')) }}
          <!--<div class="row thumbs">
            <div class="col-md-4">
              <img src="http://placehold.it/800x450" class="img-responsive">
            </div>
            <div class="col-md-4">
              <img src="http://placehold.it/800x450" class="img-responsive">
            </div>
            <div class="col-md-4">
              <img src="http://placehold.it/800x450" class="img-responsive">
            </div>
             <div class="col-md-4">
              <img src="http://placehold.it/800x450" class="img-responsive">
            </div>
            <div class="col-md-4">
              <img src="http://placehold.it/800x450" class="img-responsive">
            </div>
          </div>-->
          <form action="/file-upload" class="dropzone" id="kudos-dropzone"></form>
        </div>
        <div class="col-md-8">
        {{ Form::model($product, ['url' => 'admin/products/'.$product->id, 'method' => 'PUT']) }}
          {{ Form::hidden('shop_id', session('shop')) }}
          {{ Form::label('name', trans('products.name')) }}
          {{ Form::text('name', isset($product->$language['name']) ? $product->$language['name'] : $product->default['name'], ['class' => 'form-control', 'required' => 'required']) }}
          {{ Form::label('slug', trans('fields.slug')) }}
          {{ Form::text('slug', $product->slug, ['class' => 'form-control', 'required' => 'required']) }}
          {{ Form::label('categories', trans('categories.category')) }}
          {{ Form::select('categories', $categories, $product->categories,  ['class' => 'form-control','multiple'=>'multiple','name'=>'categories[]']) }}
          {{ Form::label('excerpt', trans('fields.excerpt')) }}
          {{ Form::textarea('excerpt', isset($product->$language['excerpt']) ? $product->$language['excerpt'] : $product->default['excerpt'], ['class' => 'form-control']) }}
          <div class="row">
            <div class="col-md-4">
              {{ Form::label('price', trans('products.price')) }}
              {{ Form::number('price', $product->price, ['class' => 'form-control', 'required' => 'required', 'step' => '0.01']) }}
              </div>
            <div class="col-md-4">
              {{ Form::label('rrp', trans('products.rrp')) }}
              {{ Form::number('rrp', $product->rrp, ['class' => 'form-control', 'step' => '0.01']) }}
            </div>
            <div class="col-md-4">
              {{ Form::label('salePrice', trans('products.sale price')) }}
              {{ Form::number('salePrice', $product->salePrice, ['class' => 'form-control', 'step' => '0.01']) }}
            </div>
          </div>
        </div>
      </div>
      <hr>
      {{ Form::label('content', trans('fields.content')) }}
      <textarea class="input-block-level wysiwyg" name="content" rows="18">{{ isset($product->$language['content']) ? $product->$language['content'] : $product->default['content'] }}</textarea>
      {{ Form::submit(trans('crud.edit'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection