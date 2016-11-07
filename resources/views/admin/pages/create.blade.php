@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <h1><a href="/admin/pages">{{ trans('pages.pages') }}</a> > {{ trans('crud.create') }}</h1>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      {{ Html::ul($errors->all(), ['class' => 'alert alert-danger']) }}
      {{ Form::open(['url' => 'admin/pages']) }}
        {{ Form::hidden('shop_id', session('shop')) }}
        {{ Form::label('name', trans('pages.name')) }}
        {{ Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('content', trans('fields.content')) }}
        <textarea class="input-block-level wysiwyg" name="content" rows="18"></textarea>
        {{ Form::submit(trans('crud.create'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
