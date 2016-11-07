@foreach ($products as $product)
  <li class="col-sm-4 col-md-2 text-center">
    <a href="/products/{{ $product->slug }}"><img src="/storage/{{ str_replace('/thumb/', '/medium/', $product->defaultImage) }}" class="img-responsive"></a>
    <h2><a href="/products/{{ $product->slug }}">{{ $product->name }}</a></h2>
    @if(!empty($product->salePrice))
    <p class="price"><i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ $product->salePrice }}</p>
    @else
    <p class="price"><i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ $product->price }}</p>
    @endif
  </li>
@endforeach