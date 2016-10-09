@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1><a href="/admin/shops">{{ trans('shops.shops') }}</a> > {{ trans('crud.edit') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          {{ Form::open(['url' => 'admin/shops/' . $shop->id]) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit(trans('crud.delete'), ['class' => 'btn btn-danger']) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      {{ Html::ul($errors->all(), ['class' => 'alert alert-danger']) }}
      {{ Form::model($shop, ['url' => 'admin/shops/'.$shop->id, 'method' => 'PUT']) }}
        {{ Form::label('name', trans('shops.shop_name')) }}
        {{ Form::text('name', isset($shop->$language['name']) ? $shop->$language['name'] : $shop->default['name'], ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('root', trans('shops.root')) }}
        @if($categories)
          <select name="root" class="form-control">
            @foreach ($categories as $cat)
              @include('admin.shops.partials.option', ['cat' => $cat])
            @endforeach
          </select>
        @else
          <select name="root" class="form-control" disabled>
            <option>{{ trans('crud.not available') }}</option>
          </select>
        @endif
        {{ Form::label('url', trans('fields.url')) }}
        {{ Form::url('url', $shop->url, ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::submit(trans('crud.edit'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
