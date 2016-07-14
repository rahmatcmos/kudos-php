@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1><a href="/admin/categories">{{ trans('categories.categories') }}</a> > {{ trans('crud.edit') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          {{ Form::open(['url' => 'admin/categories/' . $category->id]) }}
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
      {{ Form::model($category, ['url' => 'admin/categories/'.$category->id, 'method' => 'PUT']) }}
        {{ Form::hidden('shop_id', session('shop')) }}
        {{ Form::label('name', trans('categories.name')) }}
        {{ Form::text('name', isset($category->$language['name']) ? $category->$language['name'] : $category->default['name'], ['class' => 'form-control']) }}
        {{ Form::label('parent', trans('categories.parent')) }}
        <select name="parent" class="form-control">
          <option value="">{{ trans('crud.none') }}</option>
          @foreach ($categories as $cat)
            @include('admin.categories.partials.option', ['cat' => $cat])
          @endforeach
        </select>
        {{ Form::submit(trans('crud.edit'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
