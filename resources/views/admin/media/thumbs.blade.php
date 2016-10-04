@foreach ($files as $file)
<div class="col-md-6 col-lg-4">
  <a href="/storage/{{ str_replace($file_size.'/', '', $file) }}" class="btn btn-primary swipebox" target="_blank"><i class="fa fa-eye"></i></a>
  {{ Form::open(['url' => 'admin/media/delete']) }}
    {{ Form::hidden('file', $file ) }}
    {{ Form::submit('X', ['class' => 'btn btn-red']) }}
  {{ Form::close() }}
  {{ Form::open(['url' => 'admin/media/default/'.$id.'/'.$model]) }}
    {{ Form::hidden('file', $file ) }}
    <input type="image" src="/storage/{{ $file }}" data-src="{{ $file }}" class="img-responsive {{ isset($item->defaultImage) && $item->defaultImage == $file ? 'default' : '' }}">
  {{ Form::close() }}
</div>
@endforeach