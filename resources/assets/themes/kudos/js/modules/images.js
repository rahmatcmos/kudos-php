(function($, window, document) {
  $(function(){
    
    // lightbox
    $('.trigger-thumb').click( function(e){
      e.preventDefault() ;
      $('.thumbs li:eq(0) a').trigger('click') ;
    }) ;
    $( '.swipebox' ).swipebox(); 
    
  });
}(window.jQuery, window, document)); 