(function($, window, document) {
  $(function(){

    // infinite scroll
    if($('#paginate').length){
      var scrollBusy = false ;
      $('footer').hide() ;
      var page = $('#paginate').data('page') ;
      var limit = $('#paginate').data('limit') ;
      var count = $('#paginate').data('count') ;
      if(count<limit) $('footer').show() ;
      $(window).scroll(function() {
        if(!$('#paginate').data('complete') && !scrollBusy){
          if($(window).scrollTop() + $(window).height() >= $(document).height() - 1000) {
            scrollBusy = true ;
            $.ajax('/products/scroll?page='+page++)
            .done(function(data) {
              var count = $(data).filter('li').length;
              if(count<limit){
                $('#paginate').data('complete', true) ;
                // only show footer if results are complete 
                $('footer').show() ;
              }
              $('#paginate').data('page', page++) ;
              $('.results').append(data) ;
              scrollBusy = false ;
            })
            .fail(function() {
              alert( "error" );
            }) ;
          } 
        }
      });
    }

  });
}(window.jQuery, window, document)); 