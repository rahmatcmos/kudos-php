@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <h1><a href="/admin/blog">{{ trans('blog.blog') }}</a> > {{ trans('crud.create') }}</h1>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <!-- if there are creation errors, they will show here -->
      {{ Html::ul($errors->all()) }}
      {{ Form::open(['url' => 'admin/blog']) }}
        {{ Form::hidden('shop_id', session('shop')) }}
        {{ Form::label('name', trans('blog.name')) }}
        {{ Form::text('name', '', ['class' => 'form-control']) }}
        {{ Form::label('slug', trans('fields.slug')) }}
        {{ Form::text('slug', '', ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('excerpt', trans('fields.excerpt')) }}
        {{ Form::textarea('excerpt', '', ['class' => 'form-control']) }}
        {{ Form::label('content', trans('fields.content')) }}
        <textarea class="input-block-level wysiwyg" name="content" rows="18"></textarea>
        {{ Form::submit(trans('crud.create'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
