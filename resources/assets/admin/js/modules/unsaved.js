(function($, window, document) {
    var unsaved = false ;

    // mark the page as having unsaved content
   $('body').on('keyup', 'form[method=POST] input, form[method=POST] textarea, .note-editable', function() {
      unsaved = true ;
    }) ;
    
    // the user submitted the form (to save) so no need to ask them.
    $(document).on('submit', 'form[method=POST]', function(){
      unsaved = false ;
      return ; 
    }) ;
    
    // Confirm with user if they try to go elsewhere
    $(window).bind('beforeunload', function(e){;      
      if(unsaved){
        return "Page unsaved";
      }
    }) ;
  
}(window.jQuery, window, document)); 