
    //input field protected .. only for numeric
    jQuery(document).on('keyup keypress','.inputFieldValidatedOnlyNumeric',function(e){
        if (String.fromCharCode(e.keyCode).match(/[^0-9\.]/g)) return false;
    });



    jQuery(document).on('click','.productDetails',function(e){
        e.preventDefault();
        var url = jQuery('.showProductDetailsModalRoute').val();
        var id  = jQuery(this).data('id');
        jQuery.ajax({
            url:url,
            data:{id:id},
            beforeSend:function(){
                jQuery('.processing_on').fadeIn();
            },
            success:function(response){
                if(response.status == true)
                {
                    jQuery('#showProductDetailModal').html(response.html).modal('show');
                    jQuery('.display-product-stock-with-price-section').html(response.stock);
                    defaultSelectedProductStockSellingPriceAndQuantityCalculation();
                }
            },
             complete:function(){
                jQuery('.processing_on').fadeOut();
            },
        });
    });




   //hover mouseover effect
    jQuery(document).on('mouseover','.productStockHover,.selectedProductStockRow',function(e){
        e.preventDefault();
        var id = jQuery(this).data('id');
        jQuery(this).css({
            'cursor' : 'pointer'
        });
        jQuery('.productStockHover').css({
            'color':'black',
            'background-colo':'none'
        });
        jQuery('.selectedProductStockRow').css({
            'color':'black',
            'background-colo':'#ffffff'
        });

        var selectedId = jQuery('.selectedProductStockId').val();
        if(selectedId != id){
            jQuery('.selectedProductStockRow_'+id).css({
                'color':'white',
                'background-color':'#b0d5b0'
            });
        }
    });

    //hover end- mouseout 
    jQuery(document).on('mouseout','.productStockHover,.selectedProductStockRow',function(e){
        e.preventDefault();
        var id = jQuery(this).data('id');
        jQuery('.productStockHovereffect_'+id).css({
            'color':'black',
            'background-color':'none'
        });
       
        var selectedId = jQuery('.selectedProductStockId').val();
        if(selectedId != id){
            jQuery('.selectedProductStockRow_'+id).css({
                'color':'black',
                'background-color':'#ffffff'
            });
        }
    });

    
   //selected effect
   jQuery(document).on('click','.selectedProductStock ,.selectedProductStockRow',function(e){
        e.preventDefault();
        var id = jQuery(this).data('id');
        makingSelectedProductStockByProuductStockId(id);
        return true;
    });


    function makingSelectedProductStockByProuductStockId(productStockId)
    {   
        jQuery('.selectedProductStockId').val('');
            jQuery('.productStockHover').css({
                'color':'black',
                'background-colo':'#ffffff'
            });

            jQuery('.selectedProductStock').css({
                'background-color':'#ffffff !important'
            });
            
            jQuery('.selectedProductStockRow').css({
                'color':'black',
                'background-color':'#ffffff'
            });
        
            jQuery('.selectedProductStockRow_'+productStockId).css({
                'color':'#ffffff !important',
                'background-color':'#64b764'
            });
            
        jQuery('.selectedProductStockId').val(productStockId);

        makingSelecedSellingPriceByProductStockId(productStockId);
        return true;
    }



    function gettingSelectedPriceIdAccordingToDefaultPriceId()
    {
        var defaultPriceId          = jQuery(".defaultSelectedPriceId").val();
        var selectedValuePriceId    = jQuery('.selectedPriceId').val();
        if(
            (selectedValuePriceId === 'undefined' || selectedValuePriceId === null || selectedValuePriceId.length === 0)
        )
        {
            jQuery('.selectedPriceId').val(defaultPriceId);     
            selectedValuePriceId = defaultPriceId;
        }
        return selectedValuePriceId;
    }



    function makingSelecedSellingPriceByProductStockId(productStockId)
    {   
        //selected price id
        var selectedValuePriceId = gettingSelectedPriceIdAccordingToDefaultPriceId();

        var url = jQuery('.displaySinglePriceListByProductStockId').val();
        var product_stock_id    = productStockId;
        var product_id          = jQuery('#main_product_id').val();
        jQuery.ajax({
            url:url,
            data:{product_stock_id:product_stock_id,product_id:product_id},
            beforeSend:function(){
                jQuery('.processing_on').fadeIn();
            },
            success:function(response){
                if(response.status == true)
                {
                    jQuery('.selling_from_stock_name_and_selling_product_stock_price_list').html(response.stock);
                    makingSelectedSellingPriceByPriceId(selectedValuePriceId);
                }
            },
             complete:function(){
                jQuery('.processing_on').fadeOut();
            },
        });
    }


    function makingSelectedSellingPriceByPriceId(priceId)
    {
       //selected price id
       var selectedPriceId = gettingSelectedPriceIdAccordingToDefaultPriceId();
       priceId = selectedPriceId;
       
        jQuery('.selling_from_price_label').css({
            "cursor": "pointer",
            "padding-left": "7px",
            "background-color":" #e2f7f6",
            "padding-right": "7px",
            "margin-bottom": "8px",
            "width": "100%"
        });

        jQuery('.selling_from_price_label_css').css({
            "color" : "black"
        });
        
        

        jQuery('.check_when_selected').hide();
        jQuery('.uncheck_when_not_selected').show();
        jQuery('.check_when_selected_'+priceId).show();  
        jQuery('.uncheck_when_not_selected_'+priceId).hide();
 

        jQuery('.selling_from_price_label_css_'+priceId).css({
            "color" : "#ffff"
        });

        jQuery('.selling_from_price_label_'+priceId).css({
            "cursor" : "pointer",
            "padding-left" : "7px",
            "background-color" : "rgb(62,141,61,1)",  //#64b764
            "color" : "#e2f7f6",
            "padding-right" : "7px",
            "margin-bottom" : "8px",
            "width" : "100%"
        }).trigger('change');

        finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
        return true;
        /*
            selling_from_purchase_price
            selling_from_sell_price
            selling_from_mrp_price
        */
        //jQuery(".selling_from_price_id_"+priceId).prop("checked",true);//good working
        //jQuery('input[type="radio"][name="selling_price"][id="selling_from_price_id_'+priceId+'"]').prop('checked', true);//good working
        //jQuery('input[type="radio"][name="selling_price"][id="selling_from_price_id_'+priceId+'"]').attr('checked', 'checked');//good working
    }


    jQuery(document).on('click','.selling_from_price',function(e){
        e.preventDefault();
        var priceId         = jQuery(this).data('selling_from_price_id');
        var productPriceId  = jQuery(this).data('selling_from_product_price_id');
        var price           = jQuery(this).data('price_'+priceId);

        //jQuery(".selling_from_price_id_"+priceId).attr('checked', 'checked');
        //jQuery('input[type="radio"][name="selling_price"][id="selling_from_price_id_'+priceId+'"]').prop('checked', true);
        jQuery('.selectedPriceId').val(priceId);
        jQuery('.selectedSellingPrice').val(priceId);
        jQuery('.selectingSellingPriceAction').val(1);
        makingSelectedSellingPriceByPriceId(priceId);
        finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
    });

    


    var ctrlDown = false,ctrlKey = 17,cmdKey = 91,vKey = 86,cKey = 67; xKey = 88;
    jQuery(document).on('keyup change','.final_sell_price,.final_sell_quantity,.discount_type,.discount_amount',function(e){
        e.preventDefault();
        jQuery('.final_sell_price_err').text('');
        jQuery('.discount_amount_err').text('');
        var action = 0;
        if(jQuery(e.target).prop("name") == "final_sell_price" && ((e.type)=='keyup'))
        {
            jQuery('.selectingSellingPriceAction').val(0);
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "final_sell_quantity" && ((e.type)=='keyup'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "discount_amount" && ((e.type)=='keyup'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "discount_type" && ((e.type)=='change'))
        {
            action = 1;
        }
        else{
            action = 0;
        }
        if(action == 0) return;
        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
        if (ctrlDown && ( e.keyCode == vKey || e.keyCode == cKey || e.keyCode == xKey)) return false;
        finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
    });


    
    function defaultSelectedProductStockSellingPriceAndQuantityCalculation()
    {
        var productStockId = jQuery('.defaultProductStockId').val();
        makingSelectedProductStockByProuductStockId(productStockId);

        var priceId = jQuery(".defaultSelectedPriceId").val();
        jQuery('.selectedPriceId').val(priceId);
        jQuery('.selectedSellingPrice').val(priceId);
        jQuery('.selectingSellingPriceAction').val(1);
        makingSelectedSellingPriceByPriceId(priceId);
        return true;
    }


    function finalCalculationAccordingToSelectedPriceAndFinalSellPrice()
    {
        settingSellingPriceAccordingToSelectedSellingPrice();
        gettingSellingPriceFromSelectedSellingPrice();
        makingSellingPrice();
        makingSellingQuantity();

        //for discount validation
        discountAmountLessThemPurchaseAmount();
        
        makingSellingAmountWithoutDiscount();
        makingSellingDiscount();
        enabledDisabledAddToCartButton();


    }

    function settingSellingPriceAccordingToSelectedSellingPrice()
    {
        var selectedPriceId = gettingSelectedPriceIdAccordingToDefaultPriceId();
        var price = jQuery('.selling_from_price_id_'+selectedPriceId).data('price_'+selectedPriceId);
        jQuery('.selectedSellingPrice').val(price);
    }

    function gettingSellingPriceFromSelectedSellingPrice()
    {
        var selectedPriceId = gettingSelectedPriceIdAccordingToDefaultPriceId();
        var price = jQuery('.selling_from_price_id_'+selectedPriceId).data('price_'+selectedPriceId);
        return price;
    }
   
    function makingSellingPrice()
    {
        var selectedSellingPrice        = nanCheck(jQuery('.selectedSellingPrice').val());
        var selectingSellingPriceAction = jQuery('.selectingSellingPriceAction').val();
        var finalSellingPrice           = nanCheck(jQuery('.final_sell_price').val());
        var makingFinalPrice            = selectedSellingPrice;
        if(
            (finalSellingPrice === 'undefined' || finalSellingPrice === null || finalSellingPrice.length === 0)
        )
        {   
            makingFinalPrice = selectedSellingPrice;
        }else{
            if(selectingSellingPriceAction == 1)
            {
                makingFinalPrice = selectedSellingPrice;
            }else{
                makingFinalPrice = finalSellingPrice;
            }
        }
        jQuery('.final_sell_price').val(makingFinalPrice);
        return makingFinalPrice;
    }

    
    jQuery(document).on('blur','.final_sell_price',function(e){
        e.preventDefault();
        var purchasePrice           = nanCheck(parseFloat(jQuery('.selling_from_purchase_price').val()));
        var selectedSellingPrice    = nanCheck(parseFloat(jQuery('.selectedSellingPrice').val()));
        var finalSellingPrice       = nanCheck(parseFloat(jQuery('.final_sell_price').val()));
        var makingFinalPrice        = selectedSellingPrice;
        if(
            (finalSellingPrice === 'undefined' || finalSellingPrice === null || finalSellingPrice.length === 0)
        )
        {   
            makingFinalPrice = selectedSellingPrice;
        }else{
            makingFinalPrice = finalSellingPrice;
        }
        if(makingFinalPrice < purchasePrice)
        {
            jQuery('.final_sell_price_err').text('Minimum Amount '+ purchasePrice);
            makingFinalPrice = purchasePrice;
        }else{
            makingFinalPrice = finalSellingPrice;
        }
        jQuery('.final_sell_price').val(makingFinalPrice);
        return makingFinalPrice;
    });


    function makingSellingQuantity()
    {
        var finalSellingQuantity    = jQuery('.final_sell_quantity').val();
        if(
            (finalSellingQuantity === 'undefined' || finalSellingQuantity === null || finalSellingQuantity.length === 0)
        )
        {   
            jQuery('.final_sell_quantity').val(1);
            finalSellingQuantity = 1;
        }
        return  finalSellingQuantity;
    } 

    function makingSellingAmountWithoutDiscount()
    {
        var finalSellingPrice       = nanCheck(jQuery('.final_sell_price').val());
        var finalSellingQuantity    = nanCheck(jQuery('.final_sell_quantity').val());
        var totalAmountWithDiscount = ((finalSellingPrice * finalSellingQuantity).toFixed(2));
        return totalAmountWithDiscount;
    }

    function makingSellingDiscount()
    {
        var discountType        = jQuery('input[name="discount_type"]:checked').val();
        var discountAmount      = nanCheck(jQuery('.discount_amount').val());

        //discount amount always less them purchaseAmount
        var totalDiscout = makingDiscountAmountAccordingToDiscountType(discountType,discountAmount);

        jQuery('.total_discount_amount_text').text(totalDiscout);
        jQuery('.total_discount_amount_value').val(totalDiscout);

        var totalAmountWithoutDiscount  = nanCheck(makingSellingAmountWithoutDiscount());
        jQuery('.total_amount_before_discount_text').text(totalAmountWithoutDiscount);
        jQuery('.total_amount_before_discount_value').val(totalAmountWithoutDiscount);

        var finalSellingAmount          = nanCheck((totalAmountWithoutDiscount - totalDiscout).toFixed(2));
        jQuery('.selling_final_amount_text').text(finalSellingAmount);
        jQuery('.selling_final_amount_value').val(finalSellingAmount);
    }

    function makingDiscountAmountAccordingToDiscountType(discountType,discountAmount)
    {
        var totalAmountWithoutDiscount = makingSellingAmountWithoutDiscount();
        var discount = 0;
        if(discountType == 'fixed')
        {
            discount = discountAmount;
        }
        else if(discountType == 'parcentage') {
            discount = (((totalAmountWithoutDiscount * discountAmount) / 100).toFixed(2));
        }
        return discount;
    }

    function discountAmountLessThemPurchaseAmount()
    {
        var purchasePrice           = nanCheck(jQuery('.selling_from_purchase_price').val());
        var finalSellingQuantity    = nanCheck(jQuery('.final_sell_quantity').val());

        var totalAmountByPurchasePrice = purchasePrice * finalSellingQuantity;

        var discountType        = jQuery('input[name="discount_type"]:checked').val();
        var discountAmount      = nanCheck(jQuery('.discount_amount').val());

        //discount amount always less them purchaseAmount
        var totalDiscout    = makingDiscountAmountAccordingToDiscountType(discountType,discountAmount);
        var totalFinal      = finalSellingQuantity - totalDiscout;
        if((totalDiscout > totalAmountByPurchasePrice))
        {
            jQuery('.discount_amount_err').text('Invalid Less Amount');
            jQuery('.discount_amount').val(0);
        }else{
            jQuery('.discount_amount').val(discountAmount);
        }
    }
    
    function nanCheck(value)
    {
        if(isNaN(value))
        {
            return 0;
        }
        else{
            return value;
        }
    }


    function enabledDisabledAddToCartButton()
    {        
        var finalSellingAmount = nanCheck(jQuery('.selling_final_amount_value').val());
        if(finalSellingAmount > 0)
        {
            jQuery('.add_to_cart_button').removeAttr('disabled');
        }else{
            jQuery('.add_to_cart_button').attr('disabled','disabled');
        }
    }