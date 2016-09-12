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
        <div class="row">
          <div class="col-md-4">
            {{ Form::label('images', trans('fields.images')) }} ({{ trans('fields.click default')}})
            <div class="row thumbs" id="thumbnails" data-id="{{ $category->id }}" data-type="images" data-model="categories">
              @foreach ($files as $file)
              <div class="col-md-6 col-lg-4">
                <a href="/uploads/{{ str_replace($file_size.'/', '', $file) }}" class="btn btn-primary swipebox" target="_blank"><i class="fa fa-eye"></i></a>
                {{ Form::open(['url' => 'admin/media/delete']) }}
                  {{ Form::hidden('file', $file ) }}
                  {{ Form::submit('X', ['class' => 'btn btn-red']) }}
                {{ Form::close() }}
                {{ Form::open(['url' => 'admin/media/default/'.$category->id.'/category']) }}
                  {{ Form::hidden('file', $file ) }}
                  <input type="image" src="/uploads/{{ $file }}" class="img-responsive {{ isset($category->defaultImage) && $category->defaultImage == $file ? 'default' : '' }}">
                {{ Form::close() }}
              </div>
              @endforeach
            </div>
            <form action="/admin/media/upload/images/categories/{{ $category->id }}" class="dropzone" id="kudos-dropzone">
              {!! Form::token() !!}
            </form>
          </div>
          <div class="col-md-8">
            {{ Form::model($category, ['url' => 'admin/categories/'.$category->id, 'method' => 'PUT']) }}
            {{ Form::hidden('shop_id', session('shop')) }}
            {{ Form::label('name', trans('categories.name')) }}
            {{ Form::text('name', isset($category->$language['name']) ? $category->$language['name'] : $category->default['name'], ['class' => 'form-control']) }}
            {{ Form::label('slug', trans('fields.slug')) }}
            {{ Form::text('slug', $category->slug, ['class' => 'form-control', 'required' => 'required']) }}
            {{ Form::label('parent', trans('categories.parent')) }}
            <select name="parent" class="form-control">
              <option value="">{{ trans('crud.none') }}</option>
              @foreach ($categories as $cat)
                @include('admin.categories.partials.option', ['cat' => $cat])
              @endforeach
            </select>
          </div>
        </div>
        <hr>
        {{ Form::label('content', trans('fields.content')) }}
        <textarea class="input-block-level wysiwyg" name="content" rows="18">{{ isset($category->$language['content']) ? $category->$language['content'] : $category->default['content'] }}</textarea>
        {{ Form::submit(trans('crud.edit'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
