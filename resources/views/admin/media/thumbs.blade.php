@foreach ($files as $file)
<div class="col-md-4">
  {{ Form::open(['url' => 'admin/media/delete']) }}
    {{ Form::hidden('file', $file ) }}
    {{ Form::submit('X', ['class' => 'btn btn-danger btn-small']) }}
  {{ Form::close() }}
  {{ Form::open(['url' => 'admin/media/default/'.$id.'/'.$model]) }}
    {{ Form::hidden('file', $file ) }}
    {{ isset($item->defaultImage) && $item->defaultImage == $file ? 'default' : '' }}
    <input type="image" src="/uploads/{{ $file }}" class="img-responsive">
  {{ Form::close() }}
</div>
@endforeach