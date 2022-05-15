
 //input field protected .. only for numeric
jQuery(document).on('keyup keypress','.inputFieldValidatedOnlyNumeric',function(e){
    if (String.fromCharCode(e.keyCode).match(/[^0-9\.]/g)) return false;
});



jQuery(document).on('click','.productDetails',function(e){
    e.preventDefault();
    var url = jQuery('.showProductDetailsModalRoute').val();
    var id = jQuery(this).data('id');
    jQuery.ajax({
        url:url,
        data:{id:id},
        success:function(response){
            if(response.status == true)
            {
                jQuery('#showProductDetailModal').html(response.html).modal('show');
                jQuery('.display-product-stock-with-price-section').html(response.stock);
            }
        }
    });
});