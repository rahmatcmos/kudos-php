(function($, window, document) {
  $(function(){
    
    // toggle basket
    $(document).on('click', '#basket-toggle, #keep-shopping', function(e) {
      e.preventDefault() ; 
      $('#basket').slideToggle() ;
    });   
    
    // add to basket
    $("#add-to-basket").submit(function(e) {
      e.preventDefault() ; 
      //load basket
      $.ajax({
        type: 'POST',
        url: '/basket',  
        data: $(this).serialize(),
        success: function(html){
          $('#basket').html(html) ;
          $('html, body').animate({ scrollTop: 0 }, 'fast', function(){
            $('#basket').slideDown() ;
          });
        } 
      });
    }); 

  });
}(window.jQuery, window, document)); 