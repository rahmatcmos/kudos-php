<div class="modal fade" id="modal-edit-option-name" tabindex="-1" role="dialog">
  {{ Form::open(['url' => '/admin/products/'.$product->id.'/update-option-name']) }}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">{{ trans('crud.create') }} {{ trans('options.option') }}</h4>
        </div>
        <div class="modal-body">
          {{ Form::hidden('id', '') }}
          {{ Form::label('name', trans('fields.name')) }}
          {{ Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('crud.close') }}</button>
          <button type="submit" class="btn btn-primary">{{ trans('crud.edit') }}</button>
        </div>
      </div>
    </div>
  {{ Form::close() }}
</div>