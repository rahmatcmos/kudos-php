@extends('themes.basic.layouts.account')

@section('content')
<section class="container-fluid">
  <h1>{{ trans('address.addresses') }}</h1>
  <p><a href="/account/addresses/create" class="btn btn-success">{{ trans('crud.add') }} {{ trans('address.address') }}</a></p>
  @if(!$addresses->isEmpty())
  <div class="row">
    @foreach ($addresses as $address)
    <address class="col-md-4 col-lg-3">
      {{ $address->address1 }}<br>
      {!! !empty($address->address2) ? $address->address2.'<br>' : '' !!}
      {!! !empty($address->address3) ? $address->address3.'<br>' : '' !!}
      {{ $address->town }}<br>
      {{ $address->county }}<br>
      {{ $address->postcode }}<br>
      {{ $address->country }}<br>
      {{ Form::open(['url' => 'account/addresses/' . $address->id]) }}
        {{ Form::hidden('_method', 'DELETE') }}
        <a href="/account/addresses/{{ $address->id }}/edit" class="btn btn-success">{{ trans('crud.edit') }} {{ trans('address.address') }}</a>
        {{ Form::submit(trans('crud.delete'), ['class' => 'btn btn-danger']) }}
      {{ Form::close() }}
    </address>   
    @endforeach
  </div>
  @endif
</section>
@endsection
