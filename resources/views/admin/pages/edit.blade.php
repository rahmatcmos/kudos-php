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
      {{ Form::model($page, ['url' => 'admin/pages/'.$page->id, 'method' => 'PUT']) }}
        {{ Form::hidden('shop_id', session('shop')) }}
        {{ Form::label('name', trans('pages.name')) }}
        {{ Form::text('name', isset($page->$language['name']) ? $page->$language['name'] : $page->default['name'], ['class' => 'form-control']) }}
        {{ Form::submit(trans('crud.edit'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
