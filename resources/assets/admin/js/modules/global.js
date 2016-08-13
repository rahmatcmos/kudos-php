(function($, window, document) {
  $(function(){
    
    // nav
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
      var state = $('#wrapper').hasClass('toggled') ;
      $.post( "/admin/remember", { toggled: state } );
    });
    
    // shop
    $("#select-shops").change(function() {
      var id = $(this).val() ;
      $.post( "/admin/remember", { shop: id }, function() {
        window.location.replace("/admin"); 
      });
    }); 
    
    // lang
    $("#select-language").change(function() {
      var id = $(this).val() ;
      $.post( "/admin/remember", { language: id }, function() {
        location.reload() ; 
      });
    });
    
    // are you sure?, when danger is present
    $('.btn-danger, a.text-danger').click( function(e){
      e.preventDefault() ;
      if (window.confirm("Are you sure?")) {
        $(this).closest('form').submit() ; 
      }
    }) ;
    
    // wysiwyg
    $('.wysiwyg').summernote({
      height: 300,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'hr']],
        ['view', ['fullscreen', 'codeview']]
      ]
    });
    
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
  
  });
}(window.jQuery, window, document)); 