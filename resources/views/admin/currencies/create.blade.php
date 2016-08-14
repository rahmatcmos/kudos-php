@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <h1><a href="/admin/currencies">{{ trans('currencies.currencies') }}</a> > {{ trans('crud.create') }}</h1>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      {{ Form::open(['url' => 'admin/currencies']) }}
        {{ Form::label('currency', trans('currencies.currency')) }}
        {{ Form::text('currency', '', ['class' => 'form-control']) }}
        {{ Form::label('rate', trans('currencies.rate')) }}
        {{ Form::text('rate', '', ['class' => 'form-control']) }}
        {{ Form::submit(trans('crud.create'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
