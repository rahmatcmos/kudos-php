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
        
        console.log(data) ;
        
        // update the options
        $.each(data, function(i, item) {
          if($.isArray(data[i])){
            $('select[name='+i+'] option').prop('disabled', true).hide().prop('selected', false);
            $.each(data[i], function(x, y){
              $('select[name='+i+'] option[value="'+y+'"]').prop('disabled', false).show() ;
            }) ;
            $('select[name='+i+']').find('option:enabled:first').prop('selected',true);
          } 
        });
        $('#product-options select').prop("disabled", false) ;
        
        // we now have a valid product, get the sku and price
        var data = $('#add-to-basket').serializeArray() ;
        $.post('/products/'+pid+'/getOptionData', data).done(function(data){
          $('input[name=sku]').val(data.sku) ;
          $('#sku').html(data.sku) ;
          $('input[name=price]').val(parseFloat(data.price).toFixed(2)) ;
          $('#price-tag').html(parseFloat(data.price).toFixed(2)) ;
        }) ;
        
        // reenable the add to cart button
        $('#add-to-cart').prop("disabled", false) ;
      }) ;
    });
    // trigger on load
    $('#product-options select:first').trigger('change') ;
    
    // option filter in nav
    $('#option-filter select').change( function(){ 
      $('#option-filter').submit() ; 
    }) ; 

  });
}(window.jQuery, window, document)); 