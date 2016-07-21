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
  
  });
}(window.jQuery, window, document)); 
//# sourceMappingURL=all.js.map
