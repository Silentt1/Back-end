jQuery(document).ready(function(){
    // This button will increment the value
    $('.qtyplus').click(function(e){
    
     		  var qty = $(".qty").val();
    
          if(qty => 1){
	          $(".qtyminus").removeClass("qtyminusGrey");
          }
    
    
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(1);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
    
    		  var qty = $(".qty").val();
    
          if(qty <= 2){
          $(".qtyminus").addClass("qtyminusGrey");
          }
    
    
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 1) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(1);
        }
    });
    
    var qty = $(".qty").val();
    
    if(qty < 2){
    $(".qtyminus").addClass("qtyminusGrey");
    }  
    
});