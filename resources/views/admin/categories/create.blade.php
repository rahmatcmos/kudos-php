@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <h1><a href="/admin/categories">{{ trans('categories.categories') }}</a> > {{ trans('crud.create') }}</h1>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <!-- if there are creation errors, they will show here -->
      {{ Html::ul($errors->all()) }}
      {{ Form::open(['url' => 'admin/categories']) }}
        {{ Form::hidden('shop_id', session('shop')) }}
        {{ Form::label('name', trans('categories.name')) }}
        {{ Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('slug', trans('fields.slug')) }}
        {{ Form::text('slug', '', ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('parent', trans('categories.parent')) }}
        <select name="parent" class="form-control">
          <option value="">{{ trans('crud.none') }}</option>
          @foreach ($categories as $cat)
            @include('admin.categories.partials.option', ['cat' => $cat])
          @endforeach
        </select>
        {{ Form::label('content', trans('fields.content')) }}
        <textarea class="input-block-level wysiwyg" name="content" rows="18"></textarea>
        {{ Form::submit(trans('crud.create'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
