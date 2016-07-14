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
        {{ Form::text('name', '', ['class' => 'form-control']) }}
        {{ Form::label('categories', trans('categories.category')) }}
        {{ Form::select('categories', $categories, null,  ['class' => 'form-control','multiple'=>'multiple','name'=>'categories[]']) }}
        {{ Form::submit(trans('crud.create'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
