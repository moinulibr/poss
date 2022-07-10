
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


    
    //remove/delete single item from sell cart product list
    jQuery(document).on('click','.remove_this_item_from_sell_cart_list',function(e){//
        e.preventDefault();
        var product_id = jQuery(this).data('product_id');
        var url = jQuery('.removeConfirmationRequiredSingleItemFromSellAddedToCartListUrl').val();
        jQuery.ajax({
            url:url,
            data:{product_id:product_id},
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success:function(response){
                if(response.status == true)
                {
                    jQuery('#removeSingleItemFromSellAddedToCartModal').html(response.html).modal('show');
                }
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
    });  
    jQuery(document).on('click','.removeSingleItemFromSellCartProductList',function(){
        var product_id = jQuery('.remove_product_id').val();
        var url = jQuery('.removeSingleItemFromSellAddedToCartListUrl').val();
        jQuery.ajax({
            url:url,
            data:{product_id:product_id},
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success:function(response){
                if(response.status == true)
                {
                    jQuery('.display_added_to_cart_list').html(response.list);
                    jQuery('#removeSingleItemFromSellAddedToCartModal').modal('hide');
                }
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
    });  

    //remove/delete all item from sell cart product list
    jQuery(document).on('click','.removeOrEmptyAllItemFromCreateSellCartList',function(e){
        e.preventDefault();
        var url = jQuery('.removeConfirmationRequiredAllItemFromSellAddedToCartListUrl').val();
        jQuery.ajax({
            url:url,
            //data:{},
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success:function(response){
                if(response.status == true)
                {
                    jQuery('#removeAllItemFromSellAddedToCartModal').html(response.html).modal('show');
                }
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
    });
    jQuery(document).on('click','.removeOrEmptyAllItemFromSellCartProductList',function(e){
        e.preventDefault();
        var url = jQuery('.removeAllItemFromSellAddedToCartListUrl').val();
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
                    jQuery('#removeAllItemFromSellAddedToCartModal').modal('hide');
                }
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
    });


    //change quantity from added to cart list [plus or minus]
    jQuery(document).on('click','.quantityChange',function(e){
        e.preventDefault();
        var product_id  = jQuery(this).data('product_id');
        var change_type = jQuery(this).data('change_type');
        var quantity    = jQuery(this).data('quantity');
        var url = jQuery('.changeQuantityFromSellAddedToCartListUrl').val();
        jQuery.ajax({
            url:url,
            data:{product_id:product_id,change_type:change_type,quantity:quantity},
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success:function(response){
                if(response.status == true)
                {
                    jQuery('.display_added_to_cart_list').html(response.list);
                    jQuery('#removeAllItemFromSellAddedToCartModal').modal('hide');
                }
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
    });
    //change quantity from added to cart list [plus or minus]



    function finalCalculationForThisInvoice()
    {

    }

