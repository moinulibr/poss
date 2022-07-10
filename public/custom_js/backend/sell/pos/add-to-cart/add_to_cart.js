
    jQuery(document).on("submit",'.addToSaleCart',function(e){
        e.preventDefault();
        var form = jQuery(this);
        var url = form.attr("action");
        var type = form.attr("method");
        var data = form.serialize();
        jQuery('.color-red').text('');
        jQuery.ajax({
            url: url,
            data: data,
            type: type,
            datatype:"JSON",
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success: function(response){
                if(response.status == 'errors')
                {   
                    printErrorMsg(response.error);
                }
                else if(response.status == true)
                {
                    form[0].reset();
                    //jQuery('.display_added_to_cart_list').html(response.list);
                    displaySaleCreateAddedToCartProductList();
                    jQuery('#showProductDetailModal').modal('hide');
                }
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
        //end ajax

        function printErrorMsg(msg) {
            jQuery('.color-red').css({'color':'red'});
            jQuery.each(msg, function(key, value ) {
                jQuery('.'+key+'_err').text(value);
            });
        }
    });

    
    function displaySaleCreateAddedToCartProductList()
    {
        var url = jQuery('.displaySaleCreateAddedToCartProductListUrl').val();
        jQuery.ajax({
            url:url,
            //data:{},
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success:function(response){
                if(response.status == true)
                {
                    jQuery('.display_added_to_cart_list').html(response.list);
                }
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
    }

    function finalCalculationForThisInvoice()
    {

    }