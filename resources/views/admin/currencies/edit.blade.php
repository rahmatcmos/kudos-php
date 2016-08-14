@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1><a href="/admin/currencies">{{ trans('currencies.currencies') }}</a> > {{ trans('crud.edit') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          {{ Form::open(['url' => 'admin/currencies/' . $currency->id]) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit(trans('crud.delete'), ['class' => 'btn btn-danger']) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      {{ Form::model($currency, ['url' => 'admin/currencies/'.$currency->id, 'method' => 'PUT']) }}
        {{ Form::label('currency', trans('currencies.currency')) }}
        {{ Form::text('currency', $currency->currency, ['class' => 'form-control']) }}
        {{ Form::label('rate', trans('currencies.rate')) }}
        {{ Form::text('rate', $currency->rate, ['class' => 'form-control']) }}
        {{ Form::submit(trans('crud.edit'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
