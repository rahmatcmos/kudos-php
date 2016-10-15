(function($, window, document) {
  $(function(){
    
    // search
    $("header .fa-search").click(function(e) {
      e.preventDefault() ; 
      $('#search').slideToggle() ;
    });
    
  });
}(window.jQuery, window, document)); 