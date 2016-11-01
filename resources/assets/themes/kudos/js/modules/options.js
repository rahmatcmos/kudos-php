(function($, window, document) {
  $(function(){
    
    // options
    $('#product-options select').change( function(){ 
      var pid = $('input[name=id]').val() ;
      var data = $('#add-to-basket').serializeArray() ;
      data.push({name: 'initiated', value: $(this).attr('name')});
      $(this).nextAll('select').prop("disabled", true) ;
      $('#add-to-cart').prop("disabled", true) ;
      $.post('/products/'+pid+'/optionize', data)
      .done(function(data){
        
        // update the options
        $.each(data, function(i, item) {
          if($.isArray(data[i])){
            $('select[name='+i+'] option').prop('disabled', true).prop('selected', false);
            $.each(data[i], function(x, y){
              $('select[name='+i+'] option[value="'+y+'"]').prop('disabled', false) ;
            }) ;
            $('select[name='+i+']').find('option:enabled:first').prop('selected',true);
          }
        });
        $('#product-options select').prop("disabled", false) ;
        
        // we now have a valid product, get the sku and price
        var data = $('#add-to-basket').serializeArray() ;
        console.log(data) ;
        
        // reenable the add to cart button
        $('#add-to-cart').prop("disabled", false) ;
      }) ;
    });
     
  });
}(window.jQuery, window, document)); 