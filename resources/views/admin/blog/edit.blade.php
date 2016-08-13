@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1><a href="/admin/blog">{{ trans('blog.blog') }}</a> > {{ trans('crud.edit') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          {{ Form::open(['url' => 'admin/blog/' . $blog->id]) }}
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
        {{ Form::model($blog, ['url' => 'admin/blog/'.$blog->id, 'method' => 'PUT']) }}
          {{ Form::hidden('shop_id', session('shop')) }}
          {{ Form::label('name', trans('blog.name')) }}
          {{ Form::text('name', isset($blog->$language['name']) ? $blog->$language['name'] : $blog->default['name'], ['class' => 'form-control']) }}
          {{ Form::label('slug', trans('fields.slug')) }}
          {{ Form::text('slug', $blog->slug, ['class' => 'form-control', 'required' => 'required']) }}
          {{ Form::label('excerpt', trans('fields.excerpt')) }}
          {{ Form::textarea('excerpt', isset($blog->$language['excerpt']) ? $blog->$language['excerpt'] : $blog->default['excerpt'], ['class' => 'form-control']) }}
        </div>
      </div>
      <hr>
      {{ Form::label('content', trans('fields.content')) }}
      <textarea class="input-block-level wysiwyg" name="content" rows="18">{{ isset($blog->$language['content']) ? $blog->$language['content'] : $blog->default['content'] }}</textarea>
      {{ Form::submit(trans('crud.edit'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
    </div>
  </section>
    
@endsection
