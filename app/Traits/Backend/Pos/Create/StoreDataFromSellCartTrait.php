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
    protected $cartName;
    protected $product_id;

    protected $totalSellingQuantity;
    protected $otherProductStockQuantityPurchasePrice;
    protected $mainProductStockQuantityPurchasePrice;
    protected $totalPurchasePriceOfAllQuantityOfThisInvoice;



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
        $this->totalPurchasePriceOfAllQuantityOfThisInvoice = 0;
        foreach($sellCart as $cart)
        {
           $sellProduct =  $this->insertDataInTheSellProduct($sellInvoice,$cart);

            if($cart['more_quantity_from_others_product_stock'] == 1)
            {
                foreach($cart['from_others_product_stocks'] as $ostock)
                {
                   foreach($ostock['others_product_stock_ids'] as $key => $stock)
                   {
                        //$ids[] = $stock;
                        $qty = $ostock['others_product_stock_qtys'][$key];
                        $purchase_price = $ostock['others_product_stock_purchase_prices'][$key];
                        $process_duration = $ostock['over_stock_quantity_process_duration'][$key];
                        $this->insertDataInTheSellProductStockTable($cart,$sellInvoice,$sellProduct,$stock,$qty,$purchase_price,$process_duration);
                   }//end foreach
                }//end foreach
            }else{
               $this->insertDataInTheSellProductStockTable($cart,$sellInvoice,$sellProduct,$cart['selling_main_product_stock_id'],$cart['total_qty_of_main_product_stock'],$cart['purchase_price'],1);
            }
        }//end foreach
        
        $sellInvoice->total_purchase_amount = $this->totalPurchasePriceOfAllQuantityOfThisInvoice;
        $sellInvoice->total_invoice_profit = (($sellInvoiceSummeryCart['lineInvoicePayableAmountWithRounding']) - ($this->totalPurchasePriceOfAllQuantityOfThisInvoice));
        $sellInvoice->save();
        return $sellCart;
    }

    private function insertDataInTheSellProduct($sellInvoice,$cart)
    {
        $productStock = new SellProduct();
        $productStock->branch_id = 1;
        $productStock->sell_invoice_id = $sellInvoice->id;
        $productStock->product_id = $cart['product_id'];
        $productStock->unit_id = $cart['unit_id'];
        $productStock->supplier_id = $cart['supplier_id'];
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
        
        $this->totalPurchasePriceOfAllQuantityOfThisInvoice += $cart['total_purchase_price_of_all_quantity'];

        if($cart['w_g_type'])
        {
            $productStock->liability_type = json_encode(["w_g_type" => $cart['w_g_type'], "w_g_type_day" => $cart['w_g_type_day']]);
        }
        $productStock->identity_number = $cart['identityNumber'];
        $productStock->cart = NULL;//$cart[''];

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
        //$sellInvoice->total_purchase_amount = $this->totalPurchasePriceOfAllQuantityOfThisInvoice;
        //$sellInvoice->total_invoice_profit = (($sellInvoiceSummeryCart['lineInvoicePayableAmountWithRounding']) - ($this->totalPurchasePriceOfAllQuantityOfThisInvoice));
        
        $sellInvoice->save();
        return $sellInvoice;
        return $sellInvoiceSummeryCart;
    }





 
}