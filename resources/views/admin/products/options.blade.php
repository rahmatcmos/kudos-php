@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1><a href="/admin/products/{{ $product->id }}/edit">&laquo; {{ trans('crud.back') }} {{ trans('products.product') }}</a></h1>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">{{ trans('products.product') }} {{ trans('options.options') }} {{ trans('options.set') }}
          <span class="panel-btns">
            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-add-option">{{ trans('crud.add') }} {{ trans('crud.existing') }}</a>
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-create-option">{{ trans('crud.add') }} {{ trans('crud.new') }}</a>
          </span>
        </div>
        <div class="panel-body">
          @if(isset($options))
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>
                  {{ trans('options.option') }}
                </th>
                <th>
                  {{ trans('options.options') }}
                </th>
                <th width="190"></th>
              </tr>
            </thead>
            <tbody>
 
            @foreach ($options as $option)
              @php
                $lang = isset($option[$language]) ? $language : 'default' ;
              @endphp
              @foreach($option[$lang] as $name => $opt)
              <tr>
                <td>
                  <a href="#" data-name="{{ $name }}" data-id="{{ $option['_id'] }}" data-toggle="modal" data-target="#modal-edit-option-name">{{ $name }}</a>
                </td>
                <td>
                  @foreach($opt as $key => $value)
                  <a href="#" data-name="{{ $value }}" data-option-id="{{ $option['_id'] }}" data-id="{{ $key }}" data-toggle="modal" data-target="#modal-edit-option-value">{{ $value }}</a>
                  @endforeach
                </td>
                <td>
                  <a href="#" class="btn btn-warning" data-id="{{ $option['_id'] }}" data-toggle="modal" data-target="#modal-add-option-values">{{ trans('crud.add') }} {{ trans('options.options') }}</a> 
                  {{ Form::open(['url' => 'admin/products/' . $product->id.'/delete-option', 'class' => 'pull-right']) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::hidden('option', $option['_id'] )}}
                    {{ Form::submit(trans('crud.delete'), ['class' => 'btn btn-danger']) }}
                  {{ Form::close() }}
                </td>
              </tr>  
              @endforeach
            @endforeach
            </tbody>
          </table>
          <p>* {{ trans('options.warning') }}</p>
        </div>
      </div>
      @endif
      
      @if(isset($options) && !empty($options))
      <div class="panel panel-default">
        <div class="panel-heading">{{ trans('products.product') }} {{ trans('options.options') }}</div>
        <div class="panel-body">
          {{ Form::open(['url' => 'admin/products/' . $product->id.'/add-product-option']) }}    
            <table>
              <tr>
                <td>
                  <input name="sku" type="text" class="form-control" placeholder="{{ trans('products.sku') }}" required>
                </td>
                @foreach ($options as $option)
                  @php
                    $lang = isset($option[$language]) ? $language : 'default' ;
                  @endphp
                  @foreach ($option[$lang] as $name => $opt)
                  <td>
                    <select name="options[{{ $option['_id'] }}]" class="form-control" required>
                      <option value="">{{ $name }}</option>
                      @foreach($opt as $key => $value)
                      <option value="{{ $key }}">{{ $value }}</a>
                      @endforeach
                    </select>
                  </td>
                  @endforeach
                @endforeach
                <td>
                  <input name="price" type="number" class="form-control" value="{{ isset($product->salePrice) ? $product->salePrice : $product->price }}" placeholder="{{ trans('products.price') }}" required>
                </td>
                <td width="80">
                  <button type="submit" class="btn btn-success btn-block">{{ trans('crud.add') }}</button>
                </td>
              </tr>
          {{ Form::close() }}
          
          @if(isset($product->option_values) && !empty($product->option_values))
            @foreach($product->option_values as $ovId => $ov)
              <tr>
                <td>{{ $ov['sku'] }}</td>
                @foreach($ov['options'] as $oid => $id)
                  @foreach($options as $option)
                    @if($option['_id']==$oid)
                      @php
                        $lang = isset($option[$language]) ? $language : 'default' ;
                      @endphp
                      <td>{{ $option[$lang][key($option[$lang])][$id] }}</td>
                    @endif
                  @endforeach
                @endforeach
                <td>{{ number_format($ov['price'],2) }}</td>
                <td width="80">
                  <a href="/admin/products/{{ $product->id }}/delete-product-option/{{ $ovId }}" class="btn btn-danger no-submit btn-block">{{ trans('crud.delete') }}</a>
                </td>
              </tr>
            @endforeach
            </table>
          @endif
        </div>
      </div>
      @endif 
    </div>

  </section>
  
@include('admin.products.partials.create-option')
@include('admin.products.partials.add-option')
@include('admin.products.partials.add-option-values')
@include('admin.products.partials.edit-option-name')
@include('admin.products.partials.edit-option-value')
    
@endsection