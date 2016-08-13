@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <h1><a href="/admin/products">{{ trans('products.products') }}</a> > {{ trans('crud.create') }}</h1>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <!-- if there are creation errors, they will show here -->
      {{ Html::ul($errors->all()) }}
      {{ Form::open(['url' => 'admin/products']) }}
        {{ Form::hidden('shop_id', session('shop')) }}
        {{ Form::label('name', trans('products.name')) }}
        {{ Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('slug', trans('fields.slug')) }}
        {{ Form::text('slug', '', ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('categories', trans('categories.category')) }}
        {{ Form::select('categories', $categories, null,  ['class' => 'form-control','multiple'=>'multiple','name'=>'categories[]']) }}
        {{ Form::label('excerpt', trans('fields.excerpt')) }}
        {{ Form::textarea('excerpt','', ['class' => 'form-control']) }}
        <div class="row">
          <div class="col-md-4">
            {{ Form::label('price', trans('products.price')) }}
            {{ Form::number('price', '', ['class' => 'form-control', 'required' => 'required', 'step' => '0.01']) }}
            </div>
          <div class="col-md-4">
            {{ Form::label('rrp', trans('products.rrp')) }}
            {{ Form::number('rrp', '', ['class' => 'form-control', 'step' => '0.01']) }}
          </div>
          <div class="col-md-4">
            {{ Form::label('salePrice', trans('products.sale price')) }}
            {{ Form::number('salePrice', '', ['class' => 'form-control', 'step' => '0.01']) }}
          </div>
        </div>
        {{ Form::label('content', trans('fields.content')) }}
        <textarea class="input-block-level wysiwyg" name="content" rows="18"></textarea>
        
        {{ Form::submit(trans('crud.create'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
