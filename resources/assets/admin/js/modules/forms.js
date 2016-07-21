(function($, window, document) {
  $(function(){
  
    $('.btn-danger, a.text-danger').click( function(e){
      e.preventDefault() ;
      
      if (window.confirm("Are you sure?")) {
        $(this).closest('form').submit() ; 
      }
    }) ; 
  
  });
}(window.jQuery, window, document)); 