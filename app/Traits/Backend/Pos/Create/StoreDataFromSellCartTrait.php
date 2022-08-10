<?php
namespace App\Traits\Backend\Pos\Create;

use App\Models\Backend\Sell\SellInvoice;
use App\Models\Backend\Sell\SellPackage;
use App\Models\Backend\Sell\SellProduct;
use App\Models\Backend\Sell\SellProductStock;

/**
 * pricing trait
 * 
 */
trait StoreDataFromSellCartTrait
{
    protected $requestAllCartData;
    protected $cartName;
    protected $product_id;
    protected $product_name;
    protected $custom_code;

    protected $changeType;
    protected $discountType;
    protected $discountValue;
    protected $discountAmount;

    protected $mainProductStockQuantity;

    protected $changingQuantity;


    protected $saleDetails;
    protected $singleCartId;
    protected $available_status;
    protected $saleUnitPrice;
    protected $sale_unit_price;
    protected $sale_quantity;
    protected $sale_return_quantity;

    protected $identityNumber;
    protected $sale_from_stock_id;
    protected $sale_type_id;
    protected $sale_unit_id;
    protected $purchase_price;
    protected $sub_total;
    protected $selling_unit_name;
    protected $price_cat_id;


    protected $totalSellingQuantity;
    protected $otherProductStockQuantityPurchasePrice;
    protected $mainProductStockQuantityPurchasePrice;
    protected $totalPurchasePriceOfAllQuantity;



    protected function storeSessionDataFromSellCart()
    {   
        $sellCartName = sellCreateCartSessionName_hh();
        $sellCart   = [];
        $sellCart   = session()->has($sellCartName) ? session()->get($sellCartName)  : [];
        
        $sellInvoiceSummeryCartName = sellCreateCartInvoiceSummerySessionName_hh();
        $sellInvoiceSummeryCart = [];
        $sellInvoiceSummeryCart = session()->has($sellInvoiceSummeryCartName) ? session()->get($sellInvoiceSummeryCartName)  : [];
        
        echo "<pre>";
        print_r($sellCart);
        echo "</pre>";
        echo "---------------- <br/>";

       $sellInvoice =  $this->insertDataInTheSellInvoiceTable($sellInvoiceSummeryCart);
       echo "<pre>";
       print_r($sellInvoice);
       echo "</pre>";
        echo "----------------- <br/>";

        $this->totalSellingQuantity = 0;
        $this->otherProductStockQuantityPurchasePrice = 0;
        $this->mainProductStockQuantityPurchasePrice = 0;
        $this->totalPurchasePriceOfAllQuantity = 0;

        $othersStocks = [];
        $ids = [];
        foreach($sellCart as $cart)
        {
           $sellProduct =  $this->insertDataInTheSellProduct($sellInvoice,$cart);

            if($cart['more_quantity_from_others_product_stock'] == 1)
            {
                //$othersStocks = [];
                foreach($cart['from_others_product_stocks'] as $ostock)
                {
                   foreach($ostock['others_product_stock_ids'] as $key => $stock)
                   {
                        $ids[] = $stock;
                        $qty = $ostock['others_product_stock_qtys'][$key];
                        $purchase_price = $ostock['others_product_stock_purchase_prices'][$key];
                        $process_duration = $ostock['over_stock_quantity_process_duration'][$key];
                        /* echo "<br/>";
                        echo $stock;
                        echo "--------------";
                        echo "<br/>";
                       echo "qty: ". $qty = $ostock['others_product_stock_qtys'][$key];
                       echo "pp: ". $purchase_price = $ostock['others_product_stock_purchase_prices'][$key];
                       echo "pd: ". $process_duration = $ostock['over_stock_quantity_process_duration'][$key];
                        echo "<br/>";
                        echo "---------------";
                        echo "<br/>"; */
                    $this->insertDataInTheSellProductStockTable($cart,$sellInvoice,$sellProduct,$stock,$qty,$purchase_price,$process_duration);
                        /* $othersStocks[$stock] = [
                            'id_'.$stock => $stock,
                            'qty_'.$stock => $ostock['others_product_stock_qtys'][$key],
                            'purchase_price_'.$stock => $ostock['others_product_stock_purchase_prices'][$key],
                            'process_duration_'.$stock => $ostock['over_stock_quantity_process_duration'][$key],
                        ]; */
                   }//end foreach
                }//end foreach
                
            }else{
               $this->insertDataInTheSellProductStockTable($cart,$sellInvoice,$sellProduct,$cart['selling_main_product_stock_id'],$cart['total_qty_of_main_product_stock'],$cart['purchase_price'],1);
            }
        }
        
        return $ids;
        return $othersStocks;
        return $sellCart;
    }

    private function insertDataInTheSellProduct($sellInvoice,$cart)
    {
        $productStock = new SellProduct();
        $productStock->branch_id = 1;
        $productStock->sell_invoice_id = $sellInvoice->id;
        $productStock->product_id = $cart['product_id'];
        $productStock->unit_id = $cart['unit_id'];
        $productStock->supplier_id = 1;//$cart[''];
        $productStock->main_product_stock_id = $cart['selling_main_product_stock_id'];
        //$productStock->total_sell_product_stock_id = $cart[''];
        $productStock->custom_code = $cart['custom_code'];
        $productStock->quantity = $cart['final_sell_quantity'];
        $productStock->sold_price = $cart['final_sell_price'];
        $productStock->discount_amount = $cart['discount_amount'];
        $productStock->discount_type = $cart['discount_type'];
        $productStock->total_discount = $cart['total_discount_amount'];
        $productStock->reference_commission = 0;//$cart[''];
        $productStock->total_sold_price = $cart['selling_final_amount'];
        $productStock->total_purchase_price = $cart['total_purchase_price_of_all_quantity'];
        $productStock->total_profit = $cart['selling_final_amount'] - $cart['total_purchase_price_of_all_quantity'];
        if($cart['w_g_type'])
        {
            $productStock->liability_type = json_encode(["w_g_type" => $cart['w_g_type'], "w_g_type_day" => $cart['w_g_type_day']]);
        }
        $productStock->identity_number = $cart['identityNumber'];
        $productStock->cart = NULL;//$cart[''];

        
        
        /* $pStock = productStockByProductStockId_hh($product_stock_id);
        if($pStock)
        {
            $availableBaseStock = $pStock->available_base_stock;
        }else{
            $availableBaseStock = 0;
        }

        if($availableBaseStock > $qty)
        {
            //instantly processed all qty
            $instantlyProcessedQty = $qty;
            $stockProcessLaterDate = ""; 
            $stockProcessLaterQty  = 0;
        }
        else if($availableBaseStock == $qty)
        {
            //instantly processed all qty
            $instantlyProcessedQty = $qty;
            $stockProcessLaterDate = ""; 
            $stockProcessLaterQty  = 0;
        }
        else 
        {   
            //instantly processed qty
           $overStock = $qty - $availableBaseStock;
           $instantlyProcessedQty = $qty - $overStock;
           $stockProcessLaterDate = date('Y-m-d',strtotime('+'.$process_duration.' day')); 
           $stockProcessLaterQty   = $overStock;
        }

        //if sell_type==1, then reduce stock from product stocks table 

        $productStock->stock_process_instantly_qty = $instantlyProcessedQty;
        $productStock->stock_process_later_qty = $stockProcessLaterQty;
        $productStock->stock_process_later_date = $stockProcessLaterDate;
        $productStock->total_stock_remaining_process_qty = $stockProcessLaterQty;
        $productStock->total_stock_processed_qty = $instantlyProcessedQty; */

        $productStock->save();
        return $productStock;
    }

    private function insertDataInTheSellProductStockTable($cart,$sellInvoice,$sellProduct,$product_stock_id,$qty,$purchase_price,$process_duration)
    {
        $productStock = new SellProductStock();
        $productStock->branch_id = 1;
        $productStock->sell_invoice_id = $sellInvoice->id;
        $productStock->sell_product_id = $sellProduct->id;
        $productStock->product_stock_id = $product_stock_id;

        $productStock->product_id = $cart['product_id'];
        
        $productStock->total_quantity = $qty;

        $productStock->mrp_price = $cart['mrp_price'];
        $productStock->regular_sell_price = $cart['sell_price'];
        $productStock->sold_price = $cart['final_sell_price'];
        $productStock->total_sold_price = $cart['selling_final_amount'];
        $productStock->purchase_price = $cart['purchase_price'];
        $productStock->total_purchase_price = $cart['total_purchase_price_of_all_quantity'];
        $productStock->total_profit = $cart['selling_final_amount'] - $cart['total_purchase_price_of_all_quantity'];

        
        $pStock = productStockByProductStockId_hh($product_stock_id);
        if($pStock)
        {
            $availableBaseStock = $pStock->available_base_stock;
        }else{
            $availableBaseStock = 0;
        }

        if($availableBaseStock > $qty)
        {
            //instantly processed all qty
            $instantlyProcessedQty = $qty;
            $stockProcessLaterDate = ""; 
            $stockProcessLaterQty  = 0;
        }
        else if($availableBaseStock == $qty)
        {
            //instantly processed all qty
            $instantlyProcessedQty = $qty;
            $stockProcessLaterDate = ""; 
            $stockProcessLaterQty  = 0;
        }
        else 
        {   
            //instantly processed qty
           $overStock = $qty - $availableBaseStock;
           $instantlyProcessedQty = $qty - $overStock;
           $stockProcessLaterDate = date('Y-m-d',strtotime('+'.$process_duration.' day')); 
           $stockProcessLaterQty   = $overStock;
        }

        //if sell_type==1, then reduce stock from product stocks table 

        $productStock->stock_process_instantly_qty = $instantlyProcessedQty;
        $productStock->stock_process_later_qty = $stockProcessLaterQty;
        $productStock->stock_process_later_date = $stockProcessLaterDate;
        $productStock->total_stock_remaining_process_qty = $stockProcessLaterQty;
        $productStock->total_stock_processed_qty = $instantlyProcessedQty;

        $productStock->status =1;
        $productStock->delivery_status =1;
        
        $productStock->save();
        return $productStock;
    }

    private function insertDataInTheSellInvoiceTable($sellInvoiceSummeryCart)
    {  
        //return $sellInvoiceSummeryCart;
        $sellInvoice = new SellInvoice();
        $sellInvoice->branch_id = 1;
        $sellInvoice->invoice_no = 'dkfjdl';
        $sellInvoice->total_item = $sellInvoiceSummeryCart['totalItem'];
        $sellInvoice->total_quantity = $sellInvoiceSummeryCart['totalQuantity'];
        $sellInvoice->subtotal = $sellInvoiceSummeryCart['lineInvoiceSubTotal'];
        $sellInvoice->discount_amount = $sellInvoiceSummeryCart['invoiceDiscountAmount'];
        $sellInvoice->discount_type = $sellInvoiceSummeryCart['invoiceDiscountType'];
        $sellInvoice->total_discount = $sellInvoiceSummeryCart['totalInvoiceDiscountAmount'];
        $sellInvoice->vat_amount = $sellInvoiceSummeryCart['invoiceVatAmount'];
        $sellInvoice->total_vat = $sellInvoiceSummeryCart['totalVatAmountCalculation'];
        $sellInvoice->shipping_cost = $sellInvoiceSummeryCart['totalShippingCost'];
        $sellInvoice->others_cost = $sellInvoiceSummeryCart['invoiceOtherCostAmount'];
        $sellInvoice->round_amount = $sellInvoiceSummeryCart['lineInvoiceRoundingAmount'];
        $sign = "";
        if($sellInvoiceSummeryCart['lineInvoicePayableAmountWithRounding'] >=  $sellInvoiceSummeryCart['lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal'])
        {
            $sign = "+";
        }
        else if($sellInvoiceSummeryCart['lineInvoicePayableAmountWithRounding'] <  $sellInvoiceSummeryCart['lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal'])
        {
            $sign = "-";
        }else{
            $sign = "";
        }
        $sellInvoice->round_type = $sign;
        $sellInvoice->total_payable_amount = $sellInvoiceSummeryCart['lineInvoicePayableAmountWithRounding'];
        $sellInvoice->total_purchase_amount = $this->totalPurchasePriceOfAllQuantity;
        $sellInvoice->total_invoice_profit = (($sellInvoiceSummeryCart['lineInvoicePayableAmountWithRounding']) - ($this->totalPurchasePriceOfAllQuantity));
        
        $sellInvoice->save();
        return $sellInvoice;
        return $sellInvoiceSummeryCart;
    }









    //sell cart invoice summery [session:SellCartInvoiceSummery]
    protected function oldsellCartInvoiceSummery()
    {
        //return $this->requestAllCartData;
        //$this->cartName     = "SellCartInvoiceSummery";
        $cartName           = [];
        $cartName           = session()->has($this->cartName) ? session()->get($this->cartName)  : [];

        $subtotalFromSellCartList   = $this->requestAllCartData['subtotalFromSellCartList'];
        $totalItem   = $this->requestAllCartData['totalItem'];
        $invoiceDiscountAmount   = $this->requestAllCartData['invoiceDiscountAmount'];
        $invoiceDiscountType   = $this->requestAllCartData['invoiceDiscountType'];
        $totalInvoiceDiscountAmount   = $this->requestAllCartData['totalInvoiceDiscountAmount'];
        $invoiceVatAmount   = $this->requestAllCartData['invoiceVatAmount'];
        $totalVatAmountCalculation   = $this->requestAllCartData['totalVatAmountCalculation'];
        $totalShippingCost   = $this->requestAllCartData['totalShippingCost'];
        $invoiceOtherCostAmount   = $this->requestAllCartData['invoiceOtherCostAmount'];
        $totalInvoicePayableAmount   = $this->requestAllCartData['totalInvoicePayableAmount'];

        //line total calculation
        $lineInvoiceSubTotal   = number_format($this->requestAllCartData['subtotalFromSellCartList'],2,'.', '');
        $lineAfterDiscountWithInvoiceSubTotal   = number_format(($this->requestAllCartData['subtotalFromSellCartList'] - $this->requestAllCartData['totalInvoiceDiscountAmount']),2,'.', '');
        $lineAfterDiscountAndVatWithInvoiceSubTotal   = number_format((($this->requestAllCartData['subtotalFromSellCartList'] - $this->requestAllCartData['totalInvoiceDiscountAmount'])+ $this->requestAllCartData['totalVatAmountCalculation']),2,'.', '');
        $lineAfterShippingCostDiscountAndVatWithInvoiceSubTotal   = number_format((($this->requestAllCartData['subtotalFromSellCartList'] - $this->requestAllCartData['totalInvoiceDiscountAmount']) +  $this->requestAllCartData['totalVatAmountCalculation'] + $this->requestAllCartData['totalShippingCost']),2,'.', '');
        $lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal   = number_format((($this->requestAllCartData['subtotalFromSellCartList'] - $this->requestAllCartData['totalInvoiceDiscountAmount']) +  $this->requestAllCartData['totalVatAmountCalculation'] + $this->requestAllCartData['totalShippingCost'] + $this->requestAllCartData['invoiceOtherCostAmount']),2,'.', '');
        $lineInvoiceRoundingAmount   = number_format((round($lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal) - $lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal),2,'.', '');
        $lineInvoicePayableAmountWithRounding   = number_format(round($lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal),2,'.', '');

        $cartName = [
            'subtotalFromSellCartList'=> $subtotalFromSellCartList,
            'totalItem'=> $totalItem,
            'invoiceDiscountAmount'=> $invoiceDiscountAmount,
            'invoiceDiscountType'=> $invoiceDiscountType,
            'totalInvoiceDiscountAmount'=> $totalInvoiceDiscountAmount,
            'invoiceVatAmount'=> $invoiceVatAmount,
            'totalVatAmountCalculation'=> $totalVatAmountCalculation,
            'totalShippingCost'=> $totalShippingCost,
            'invoiceOtherCostAmount'=> $invoiceOtherCostAmount,
            'totalInvoicePayableAmount'=> $totalInvoicePayableAmount,

            //line total calculation store in session
            'lineInvoiceSubTotal'=> $lineInvoiceSubTotal,
            'lineAfterDiscountWithInvoiceSubTotal'=> $lineAfterDiscountWithInvoiceSubTotal,
            'lineAfterDiscountAndVatWithInvoiceSubTotal'=> $lineAfterDiscountAndVatWithInvoiceSubTotal,
            'lineAfterShippingCostDiscountAndVatWithInvoiceSubTotal'=> $lineAfterShippingCostDiscountAndVatWithInvoiceSubTotal,
            'lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal'=> $lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal,
            'lineInvoiceRoundingAmount'=> $lineInvoiceRoundingAmount,
            'lineInvoicePayableAmountWithRounding'=> $lineInvoicePayableAmountWithRounding,
        ];
        session([$this->cartName => $cartName]);
        return $this->cartName;
        /* $subtotalFromSellCartList = $request->subtotalFromSellCartList;
        $totalItem = $request->totalItem;
        $invoiceDiscountAmount = $request->invoiceDiscountAmount;
        $invoiceDiscountType = $request->invoiceDiscountType;
        $totalInvoiceDiscountAmount = $request->totalInvoiceDiscountAmount;
        $invoiceVatAmount = $request->invoiceVatAmount;
        $totalVatAmountCalculation = $request->totalVatAmountCalculation;
        $totalShippingCost = $request->totalShippingCost;
        $invoiceOtherCostAmount = $request->invoiceOtherCostAmount;
        $totalInvoicePayableAmount = $request->totalInvoicePayableAmount;
        return $request; */
    }

    //adding to sell cart [session:SellCreateAddToCart]
    protected function oldaddingToCartWhenSellCreate()
    {
        //return $this->requestAllCartData;
        //$this->cartName     = "SellCreateAddToCart";
        $cartName           = [];
        $cartName           = session()->has($this->cartName) ? session()->get($this->cartName)  : [];

        $this->product_id   = $this->requestAllCartData['product_id'];
        $this->product_name = $this->requestAllCartData['product_name'];
        $this->custom_code  = $this->requestAllCartData['custom_code'];

        $otherProductStockQuantity                      = 0;
        $this->otherProductStockQuantityPurchasePrice   = 0;
        $this->mainProductStockQuantity                 = 0;
        $othersProductStocks = [];
        if($this->requestAllCartData['more_quantity_from_others_product_stock'] == 1)
        {
            if(count($this->requestAllCartData['product_stock_id']) > 0)
            {
                foreach($this->requestAllCartData['product_stock_id'] as $productStockId)
                {
                    $othersProductStocks[$this->product_id]['others_product_stock_ids'][]               = $productStockId;  
                    $othersProductStocks[$this->product_id]['others_product_stock_qtys'][]              = $this->requestAllCartData['product_stock_quantity_'.$productStockId] ;  
                    $othersProductStocks[$this->product_id]['others_product_stock_purchase_prices'][]   = $this->requestAllCartData['product_stock_quantity_purchase_price_'.$productStockId] ;  
                    $othersProductStocks[$this->product_id]['over_stock_quantity_process_duration'][]   = $this->requestAllCartData['over_stock_quantity_process_duration_'.$productStockId] ;  
                    
                    if($productStockId != $this->requestAllCartData['selling_main_product_stock_id'])
                    {
                        $otherProductStockQuantity                      += $this->requestAllCartData['product_stock_quantity_'.$productStockId];
                        $this->otherProductStockQuantityPurchasePrice   += ($this->requestAllCartData['product_stock_quantity_purchase_price_'.$productStockId] * $this->requestAllCartData['product_stock_quantity_'.$productStockId]);
                    }else{
                        $this->mainProductStockQuantity     += $this->requestAllCartData['product_stock_quantity_'.$productStockId];
                    }
                }
            }
        }else{
            $this->mainProductStockQuantity         = $this->requestAllCartData['final_sell_quantity'];
        }
        //{"36":{"others_product_stock_ids":["137","138","139","140"],"others_product_stock_qtys":["10","2","1","2"],"others_product_stock_purchase_prices":["10.00","9.00","11.00","9.00"]}}
        $this->mainProductStockQuantityPurchasePrice    = $this->mainProductStockQuantity * $this->requestAllCartData['purchase_price'];
        $this->totalPurchasePriceOfAllQuantity          = $this->mainProductStockQuantityPurchasePrice + $this->otherProductStockQuantityPurchasePrice;

        $cartName[$this->product_id] = [
            'product_id'                                => $this->product_id,
            'custom_code'                               => $this->custom_code,
            'product_name'                              => $this->product_name,
            'warehouse_id'                              => $this->requestAllCartData['warehouse_id'],
            'warehouse_rack_id'                         => $this->requestAllCartData['warehouse_rack_id'],
            'unit_id'                                   => $this->requestAllCartData['unit_id'],
            'unit_name'                                 => $this->requestAllCartData['unit_name'],
            'selling_main_product_stock_id'             => $this->requestAllCartData['selling_main_product_stock_id'],

            'purchase_price'                            => $this->requestAllCartData['purchase_price'],
            'sell_price'                                => $this->requestAllCartData['sell_price'],
            'mrp_price'                                 => $this->requestAllCartData['mrp_price'],
            'final_sell_price'                          => $this->requestAllCartData['final_sell_price'],
            'final_sell_quantity'                       => $this->requestAllCartData['final_sell_quantity'],
            'discount_type'                             => $this->requestAllCartData['discount_type'],
            'discount_amount'                           => $this->requestAllCartData['discount_amount'],
            'total_amount_before_discount'              => $this->requestAllCartData['total_amount_before_discount'],
            'total_discount_amount'                     => $this->requestAllCartData['total_discount_amount'],
            'selling_final_amount'                      => $this->requestAllCartData['selling_final_amount'],
            'main_product_stock_quantity_purchase_price'=> $this->mainProductStockQuantityPurchasePrice,
            'others_product_stock_quantity_purchase_price'=> $this->otherProductStockQuantityPurchasePrice,
            'total_purchase_price_of_all_quantity'      => $this->totalPurchasePriceOfAllQuantity,

            'more_quantity_from_others_product_stock'   => $this->requestAllCartData['more_quantity_from_others_product_stock'],
            'from_others_product_stocks'                => $othersProductStocks,
            'total_qty_from_others_product_stock'       => $otherProductStockQuantity,
            'total_qty_of_main_product_stock'           => $this->mainProductStockQuantity,
            'w_g_type'                                  => $this->requestAllCartData['w_g_type'],
            'w_g_type_day'                              => $this->requestAllCartData['w_g_type_day'],
            'identityNumber'                            => $this->requestAllCartData['identityNumber'],
        ];
        session([$this->cartName => $cartName]);
        return true;
        if(array_key_exists($this->product_id,$cartName))
        {
            //$cartName[$this->saleDetails->id]['sale_price']           = number_format($sale_price,2,'.', '');
            //$cartName[$this->saleDetails->id]['quantity']             = $quantity;
        }
        else{
            $cartName[$this->product_var_id] = [
                'price_cat_id'              => $this->saleDetails->price_cat_id,
                'productVari_id'            => $this->saleDetails->product_variation_id,
                'product_id'                => $this->saleDetails->product_id,
                'sale_from_stock_id'        => $this->saleDetails->sale_from_stock_id,
                'selling_unit_name'         => $this->saleDetails->units?$this->saleDetails->units->short_name:NULL,
                'sale_type_id'              => $this->saleDetails->sale_type_id,
                'identityNumber'            => $this->saleDetails->saleWarrantyGrarantees?$this->saleDetails->saleWarrantyGrarantees->identity_number:NULL,
            ];
        }
        session([$this->cartName => $cartName]);
        return true;
    }
    
 
}