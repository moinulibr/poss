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


//stock
function unitView_hh($unitId,$stockQuantity)
{
    $unit = Unit::find($unitId);
    return $stockQuantity / $unit->calculation_result;
}