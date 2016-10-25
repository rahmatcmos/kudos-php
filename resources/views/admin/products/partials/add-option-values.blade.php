<div class="modal fade" id="modal-add-option-values" tabindex="-1" role="dialog">
  {{ Form::open(['url' => 'admin/products/' . $product->id.'/add-options']) }}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">{{ trans('crud.create') }} {{ trans('options.option') }}</h4>
        </div>
        <div class="modal-body">
          {{ Form::hidden('id', '') }}
          {{ Form::label('options', trans('options.options')) }}
          <input type="text" name="options" value="" data-role="tagsinput" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('crud.close') }}</button>
          <button type="submit" class="btn btn-primary">{{ trans('crud.add') }}</button>
        </div>
      </div>
    </div>
  {{ Form::close() }}
</div>