(function($, window, document) {
  $(function(){
    
    // slug generate
    $('#name').blur(function(){
      if($('#slug').length && $('#slug').val()==''){
        var slug = $(this).val() ;
        var token = $('input[name=_token]').val() ;
        var url = '/admin/slugify' ;
        $.post(url, { '_token': token, 'slug': slug })
        .done(function( data ) {
          $('#slug').val( data ) ;
        }) ;
      }
    });
      
  });
}(window.jQuery, window, document)); 