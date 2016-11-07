(function($, window, document) {
  $(function(){

    // category toggle
    $('.category-toggle').click(function(e){
      e.preventDefault();
      $('nav .categories').slideToggle() ;
    }) ;
    
    // filter toggle
    $('.filter-toggle').click(function(e){
      e.preventDefault();
      $('nav form').slideToggle() ;
    }) ;
    
  });
}(window.jQuery, window, document)); 