<?php

use App\Models\Backend\ProductAttribute\Unit;
use Illuminate\Support\Facades\Auth;


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