(function($, window, document) {
  $(function(){
    
    // add option name to modal
    $('a[data-target="#modal-add-option-values"').click(function(){
      $('#modal-add-option-values input[name="id"]').val( $(this).data('id') ) ;
    }) ;
  
    // add option to edit option name modal
    $('a[data-target="#modal-edit-option-name"').click(function(){
      $('#modal-edit-option-name input[name="id"]').val( $(this).data('id') ) ;
      $('#modal-edit-option-name input[name="name"]').val( $(this).data('name') ) ;
    }) ;
    
    // add option to edit option value modal
    $('a[data-target="#modal-edit-option-value"').click(function(){
      $('#modal-edit-option-value input[name="id"]').val( $(this).data('id') ) ;
      $('#modal-edit-option-value input[name="option_id"]').val( $(this).data('option-id') ) ;
      $('#modal-edit-option-value input[name="name"]').val( $(this).data('name') ) ;
    }) ;
    
    // add a new option
    $('#options-create').click(function(){
      var html = $('.template').html();
      $('.option-values').append(html) ;
    }) ;
  
  });
}(window.jQuery, window, document)); 