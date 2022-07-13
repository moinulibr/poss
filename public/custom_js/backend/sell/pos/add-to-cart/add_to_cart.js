
    jQuery(document).ready(function(){
        displaySaleCreateAddedToCartProductList();
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
                   finalCalculationForThisInvoice();
               }
           },
           complete:function(){
               jQuery('.processing').fadeOut();
           },
       });
   }


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
                    jQuery('.display_added_to_cart_list').html(response.list);
                    //displaySaleCreateAddedToCartProductList();
                    jQuery('#showProductDetailModal').modal('hide');
                    jQuery.notify(response.message, response.type);
                    finalCalculationForThisInvoice();
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
                    jQuery.notify(response.message, response.type);
                    finalCalculationForThisInvoice();
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
    jQuery(document).on('click','.removeOrEmptyAllItemFromSellCartProductList',function(){
        var url = jQuery('.removeAllItemFromSellAddedToCartListUrl').val();
        jQuery.ajax({
            url:url,
            //data:{},
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success:function(response){
                jQuery('#removeAllItemFromSellAddedToCartModal').modal('hide');
                jQuery('.display_added_to_cart_list').html(response.list);
                jQuery.notify(response.message, response.type);
                finalCalculationForThisInvoice();
            },
            complete:function(){
                jQuery('.processing').fadeOut();
                jQuery('#removeAllItemFromSellAddedToCartModal').modal('hide');
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
                    jQuery.notify(response.message, response.type);
                }
                finalCalculationForThisInvoice();
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
    });
    //change quantity from added to cart list [plus or minus]



    function finalCalculationForThisInvoice()
    {
        totalItemFromCartList();
        var subtotal = subtotalFromCartList();
        makingInvoiceDiscount();
        setInvoiceDiscount(); 
        var totalInvoiceDiscount                = nanCheck(parseFloat(jQuery('.invoiceFinalTotalDiscountAmount').text()));
        var invoiceFinalTotalVatAmount          = nanCheck(parseFloat(jQuery('.invoiceFinalTotalVatAmount').text()));
        var invoiceFinalTotalOtherCostAmount    = nanCheck(parseFloat(jQuery('.invoiceFinalTotalOtherCostAmount').text()));
        var invoiceFinalShippingCostAmount      = nanCheck(parseFloat(jQuery('.invoiceFinalShippingCostAmount').text()));
        var netInvoiceTotalAmount               = (subtotal - totalInvoiceDiscount)+invoiceFinalTotalVatAmount+invoiceFinalTotalOtherCostAmount+invoiceFinalShippingCostAmount;
        jQuery('.netPayableInvoiceTotal').text(netInvoiceTotalAmount);
    }

    function subtotalFromCartList()
    {
        var subtotalFromCartList = 0;
        jQuery(".selling_final_subtotal_amount_from_cartlist").each(function() {
            subtotalFromCartList += nanCheck(parseFloat(jQuery(this).val()));
        });
        jQuery('.subtotalFromSellCartList').text(subtotalFromCartList);
        jQuery('.subtotalFromSellCartListValue').val(subtotalFromCartList);
        return subtotalFromCartList;
    } 
    function totalItemFromCartList()
    {
       var totalItme = jQuery(".total_item_from_cartlist").val();
       jQuery('.totalItemFromSellCartList').text(totalItme);
       return totalItme;
    }

    var ctrlDown = false,ctrlKey = 17,cmdKey = 91,vKey = 86,cKey = 67; xKey = 88;
    jQuery(document).on('keyup blur change','.invoice_discount_amount ,.invoice_discount_type',function(e){
        e.preventDefault();
        var action = 0;
        if(jQuery(e.target).prop("name") == "invoice_discount_amount" && ((e.type)=='keyup'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "invoice_discount_amount" && ((e.type)=='blur' || (e.type)=='focusout'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "invoice_discount_type" && ((e.type)=='change'))
        {
            action = 1;
        }
        else{
            action = 0;
        }
        if(action == 0) return;
        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
        if (ctrlDown && ( e.keyCode == vKey || e.keyCode == cKey || e.keyCode == xKey)) return false;

        makingInvoiceDiscount();
        setInvoiceDiscount(); 
        finalCalculationForThisInvoice();
    });

    function makingInvoiceDiscount()
    {
        var invoiceDiscountAmount       = jQuery('.invoice_discount_amount').val();
        var invoiceDiscountType         = jQuery('.invoice_discount_type option:selected').val();
        var subtotalFromSellCartList    = nanCheck(parseFloat(jQuery('.subtotalFromSellCartListValue').val())); 
        var totalInvoiceDiscountAmount  = 0; 
        if(invoiceDiscountType == 'fixed'){
            totalInvoiceDiscountAmount  = invoiceDiscountAmount;
        }
        else if(invoiceDiscountType == 'percentage'){
            totalInvoiceDiscountAmount = ((invoiceDiscountAmount * subtotalFromSellCartList) / 100);
        }else{
            totalInvoiceDiscountAmount  = 0; 
        }
        var invoiceSubtotalAfterDiscount = subtotalFromSellCartList - totalInvoiceDiscountAmount;
        
        jQuery('.invoice_totoal_discount_amount').text(totalInvoiceDiscountAmount);
        jQuery('.invoice_subtotal_after_discount').text(invoiceSubtotalAfterDiscount);
        setInvoiceDiscount(); 
    }
    jQuery(document).on('click','.invoiceDiscountApplyModal',function(){
        makingInvoiceDiscount();
    });  
    jQuery(document).on('click','.invoice_discount_apply',function(){
        makingInvoiceDiscount();
        
        setInvoiceDiscount(); 
        
        finalCalculationForThisInvoice();
        jQuery('#discountpop').modal('hide');
    });

    function setInvoiceDiscount()
    {
        var getInvoiceDiscountAmount    = jQuery('.invoice_discount_amount').val();
        var invoiceDiscountType         = jQuery('.invoice_discount_type option:selected').val();
        var totalDiscountAmount         = nanCheck(parseFloat(jQuery('.invoice_totoal_discount_amount').text()));
        var setInvoiceDiscountType      = ""; 
        var setInvoiceDiscountAmount = 0; 
        if(invoiceDiscountType == 'fixed'){
            setInvoiceDiscountType      = "";
            setInvoiceDiscountAmount    = getInvoiceDiscountAmount; 
        }
        else if(invoiceDiscountType == 'percentage'){
            setInvoiceDiscountType      = "%";
            setInvoiceDiscountAmount    = getInvoiceDiscountAmount; 
        }else{
            setInvoiceDiscountType      = ""; 
            setInvoiceDiscountAmount    = 0; 
        }
        jQuery('.invoiceDiscountAmount').text(setInvoiceDiscountAmount);
        jQuery('.invoiceDiscountType').text(setInvoiceDiscountType);
        jQuery('.invoiceFinalTotalDiscountAmount').text(totalDiscountAmount);
    }
