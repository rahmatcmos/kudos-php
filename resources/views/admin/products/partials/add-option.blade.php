<div class="modal fade" id="modal-add-option" tabindex="-1" role="dialog">
  {{ Form::open(['url' => 'admin/products/' . $product->id.'/add-existing-option']) }}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">{{ trans('crud.add') }} {{ trans('crud.existing') }} {{ trans('options.option') }}</h4>
        </div>
        <div class="modal-body">
          {{ Form::label('option_id', trans('options.option')) }}
          <select name="option_id">
            @foreach($availableOptions as $option)
              <option value="{{ $option->_id }}">{{ isset($option->$language) ? key($option->$language) : key($option->default) }}</option>
            @endforeach
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('crud.close') }}</button>
          <button type="submit" class="btn btn-primary">{{ trans('crud.add') }}</button>
        </div>
      </div>
    </div>
  {{ Form::close() }}
</div>