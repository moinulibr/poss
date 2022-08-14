<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Price\ProductPrice;
use App\Models\Backend\ProductAttribute\Unit;
use App\Models\Backend\Stock\ProductStock;

    function authBranch_hh()
    {
        return Auth::guard('web')->user()->branch_id;
        //Auth::guard('web')->user()->id;
    }
    function authId_hh()
    {
        return Auth::guard('web')->user()->id;
    }


    function regularStockId_hh()
    {
        return 1;
    }
    function regularSellId_hh()
    {
        return 2;
    }
    function mrpSellId_hh()
    {
        return 1;
    }
    function purchasePriceId_hh()
    {
        return 5;
    }

    function sellCreateCartSessionName_hh()
    {
        return "SellCreateAddToCart"; 
    }
    function sellCreateCartInvoiceSummerySessionName_hh()
    {
        return "SellCartInvoiceSummery";
    } 
    function sellCreateCartShippingAddressSessionName_hh()
    {
        return "customerShippingAddress";
    }

    //get only single price, by product id,product stock id, stock id, price id
    function getProductPriceByProductStockIdProductIdStockIdPriceId_hh($productId,$productStockId,$stockId,$priceId)
    {
        $price = ProductPrice::where('product_id',$productId)->where('stock_id',$stockId)
                    ->where('product_stock_id',$productStockId)
                    ->where('price_id',$priceId)//purchase price 
                    ->first();
        return $price ? $price->price : 0 ;
    }


    function defaultProductImageUrl_hh()
    {
        return 'storage/backend/default/product/default.png';
    }
    function productStoreImageLocation_hh()
    {
        return 'backend/product/product/';
    }
    function productImageViewLocation_hh()
    {
        return 'storage/backend/product/product/';
    }
    function defaultUserImageUrl_hh()
    {
        return 5;
    }
    function userImageLocation_hh()
    {
        return 5;
    }

    function defaultSelectedProductStockId_hh()
    {
        return 1;
    }
    function defaultSelectedPriceId_hh()
    {
        return 1;
    }

    function unitIdWiseUnitView_hh(
        $available_stock,$available_base_stock,
        $purchase_unit_id,$changing_unit_id
    )
    {
        $totalStock = $available_base_stock;
        if($purchase_unit_id == $changing_unit_id)
        {
            $totalStock =  $available_base_stock; 
        }else{
            $result = Unit::find($changing_unit_id)->calculation_result;
            $totalBaseStock = $available_stock / $result;
            return $totalBaseStock;
        }
        return $totalStock;
    }

    //stock
    function unitView_hh($unitId,$stockQuantity)
    {
        $unit = Unit::find($unitId);
        return $stockQuantity / $unit->calculation_result;
    }


    //sell applicable when selling price is less than purchase price
    function sellApplicableOrNotWhensellingPriceIsLessThanPurchasePrice_hh()
    {
        return 1;
        // 1 = yes sell, when selling price is less than purchase price
        // 0 = not sell, when selling price is less than purchase price
    } 

    // sell applicable when stock is less than zero
    function sellApplicableOrNotWhenStockIsLessThanZero_hh()
    {
        return 1;
        // 1 = not sell, when product stock is less than zero (stock will be never minus)
        // 0 = yes sell, when product stock is less than zero (stock will be never minus)
    }
    function sellApplicableOrNotWhenTotalDiscountAmountIsGreaterThanTotalPurchasePrice_hh()
    {
        return 1;
        // 1 = yes sell, when total discount amout is less than total purchase price
        // 0 = not sell, when total discount amout is less than total purchase price
    }
    
    function displayMrpOrRegularSellPriceInTheCustomerInvoice_hh()
    {
        return 1;
        // 0 = regular sell price
        // 1 = mrp price
    }

    //vat
    function vatApplicableOrNotWhenSellCreate_hh()
    {
        return 0;
        // 0 = no
        // 1 = yes
    }
    function vatApplicableOrNotWithVatAmountWhenSellCreate_hh()
    {
       if(vatApplicableOrNotWhenSellCreate_hh() == 1)
       {
            return 5; 
       }else{
        return 0;
       }
    }
    function vatCustomizationApplicableOrNotWhenSellCreate_hh()
    {
        return 0;
        // 0 = no
        // 1 = yes
    }
    //vat


    //product stock
    function productStockByProductStockId_hh($id)
    {
        $pstock = ProductStock::findOrFail($id);
        if($pstock)
        {
            return $pstock;
        }
        return NULL;
    }