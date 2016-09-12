(function($, window, document) {
  $(function(){
    
    // dropzone
    if( $('#kudos-dropzone').length ){
      Dropzone.autoDiscover = false;
      var kudosDropzone = new Dropzone('#kudos-dropzone', {
        maxFilesize: 2, // MB
        acceptedFiles: '.png,.jpg'
      }) ; ;
      kudosDropzone.on('success', function(file) {
        kudosDropzone.removeFile(file);
      });
      kudosDropzone.on('queuecomplete', function() {
        var id = $('#thumbnails').data('id') ;
        var type = $('#thumbnails').data('type') ;
        var model = $('#thumbnails').data('model') ;
        $.get( '/admin/media/thumbnails/'+id+'/'+model+'/'+type, function( data ) {
          $('#thumbnails').html( data );
        });
      });
    }
    
    // delete image
    $(document).on('click', '#thumbnails input[type=submit]', function(e){
      e.preventDefault() ;
      if (window.confirm("Are you sure?")) {
        var close = $(this) ;
        var file = close.prev() ;
        var token = file.prev().val() ;
        $.post('/admin/media/delete', { 'file': file.val(), '_token': token })
        .done(function() {
          close.closest('div').hide() ;
        }) ;
      }
    }) ;
    
    // set default image
    $(document).on('click', '#thumbnails input[type=image]', function(e){
      e.preventDefault() ;
      var thumb = $(this) ;
      var url = $(this).closest('form').attr('action') ;
      var token = thumb.prev().prev().val() ;
      $.post(url, { '_token': token, 'file': thumb.data('src') })
      .done(function() {
        $('#thumbnails input[type=image]').removeClass('default') ;
        thumb.addClass('default') ;
      }) ;
    }) ;
     
    // lightbox
    $( '.swipebox' ).swipebox();
  
  });
}(window.jQuery, window, document)); 