@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1><a href="/admin/pages">{{ trans('pages.pages') }}</a> > {{ trans('crud.edit') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          {{ Form::open(['url' => 'admin/pages/' . $page->id]) }}
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
          <div class="row thumbs" id="thumbnails" data-id="{{ $page->id }}" data-type="images" data-model="pages">
            @foreach ($files as $file)
            <div class="col-md-6 col-lg-4">
              <a href="/uploads/{{ $file }}" class="btn btn-primary swipebox" target="_blank"><i class="fa fa-eye"></i></a>
              {{ Form::open(['url' => 'admin/media/delete']) }}
                {{ Form::hidden('file', $file ) }}
                {{ Form::submit('X', ['class' => 'btn btn-red']) }}
              {{ Form::close() }}
              {{ Form::open(['url' => 'admin/media/default/'.$page->id.'/product']) }}
                {{ Form::hidden('file', $file ) }}
                <input type="image" src="/uploads/{{ $file }}" class="img-responsive {{ isset($page->defaultImage) && $page->defaultImage == $file ? 'default' : '' }}">
              {{ Form::close() }}
            </div>
            @endforeach
          </div>
          <form action="/admin/media/upload/images/pages/{{ $page->id }}" class="dropzone" id="kudos-dropzone">
            {!! Form::token() !!}
          </form>
        </div>
        <div class="col-md-8">
        {{ Form::model($page, ['url' => 'admin/pages/'.$page->id, 'method' => 'PUT']) }}
          {{ Form::hidden('shop_id', session('shop')) }}
          {{ Form::label('name', trans('pages.name')) }}
          {{ Form::text('name', isset($page->$language['name']) ? $page->$language['name'] : $page->default['name'], ['class' => 'form-control']) }}
          {{ Form::label('slug', trans('fields.slug')) }}
          {{ Form::text('slug', $page->slug, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
      </div>
      <hr>
      {{ Form::label('content', trans('fields.content')) }}
      <textarea class="input-block-level wysiwyg" name="content" rows="18">{{ isset($page->$language['content']) ? $page->$language['content'] : $page->default['content'] }}</textarea>
      {{ Form::submit(trans('crud.edit'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
    </div>
  </section>
    
@endsection
