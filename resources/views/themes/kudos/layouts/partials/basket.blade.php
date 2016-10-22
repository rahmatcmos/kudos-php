<section id="basket">
  <div class="container">
    @if(!session('basket')['items'])
      <p>{{ trans('basket.empty') }}</p>
    @else
    <div class="row outer">
      <div class="col-md-8 left">
        <ul class="row">
          <li class="col-md-2 col-md-offset-7 text-right">
            {{ trans('basket.price') }}
          </li>
          <li class="col-md-3 text-right">
            {{ trans('basket.quantity') }}
          </li>
        </ul>
        <hr>
        @foreach(session('basket')['items'] as $id => $item)
        <ul class="row">
          <li class="col-md-2 text-right">
            <a href="/products/{{ $item['product']['slug'] }}">
              <img src="/storage/{{ str_replace('/large/', '/thumb/', $item['product']['defaultImage']) }}" class="img-responsive">
            </a>
          </li>
          <li class="col-md-5">
            <h2>
              <a href="/products/{{ $item['product']['slug'] }}">
                {{ isset($item['product'][session('language')]['name']) ? $item['product'][session('language')]['name'] : $item['product']['default']['name'] }}
              </a>
            </h2>
            {{ Form::open(['method' => 'DELETE', 'url' => 'basket/'.$id]) }}
              {{ Form::submit('delete', ['class' => 'btn btn-link orange']) }}
            {{ Form::close() }}
          </li>
          <li class="col-md-2 text-right price">
            <i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ number_format($item['price'],2) }}
          </li>
          <li class="col-md-3 text-right">
            @if($item['qty'] > 10)
              {{ $item['qty'] }}
            @else
              {{ Form::open(['method' => 'PUT', 'url' => 'basket/'.$id]) }}
                @php $range = range(0,10) ; unset($range[0]) @endphp
                {{ Form::select('qty', $range, $item['qty']) }}
                {{ Form::submit('update', ['class' => 'btn btn-link green']) }}
              {{ Form::close() }}
            @endif
          </li>
        </ul>
        <hr>
        @endforeach
      </div>
      <div class="col-md-4 right">
        <div class="actions">
          @if(!empty(session('basket')))
          <p class="text-right subtotal">
            {{ trans('orders.subtotal') }}: <strong class="price"><i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ number_format(session('basket')['subtotal'], 2) }}</strong>
          </p>
          <p class="text-right">
            <a href="#" class="btn btn-warning btn-checkout btn-lg" id="keep-shopping">
              {{ trans('checkout.keepshopping') }}
            </a>
            <a href="/checkout" class="btn btn-success btn-checkout btn-lg">
              {{ trans('checkout.checkout') }}
            </a>
          </p>
          @endif
        </div>
      </div>
    </div>
    @endif
  </div>
</section>