<?php
    namespace App\Traits\Backend\Stock\Logical;

use App\Models\Backend\Stock\Stock;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Stock\StockHistory;
use App\Traits\Backend\ProductAttribute\Unit\Locial\UnitTrait;
/**
 * 
 */
trait StockChangingTrait
{
    use UnitTrait;

    protected $stock_type_id_forStockChangingTrait;
    protected $product_id_forStockChangingTrait;
    protected $sell_price_forStockChangingTrait;
    protected $whole_sell_price_forStockChangingTrait;
    protected $offer_price_forStockChangingTrait;
    protected $mrp_price_forStockChangingTrait;
    protected $purchase_price_forStockChangingTrait;
    protected $unit_id_forStockChangingTrait;
    protected $stock_quantity_forStockChangingTrait;

    
    protected $stock_changing_type_id_forStockHistoryStockChangingTrait;
    protected $stock_changing_sign_forStockHistoryStockChangingTrait;
    protected $stock_changing_history_forStockHistoryStockChangingTrait;

    private $current_stock_id;

    private $current_available_stock;
    private $current_available_base_stock;
    private $current_used_stock;
    private $current_used_base_stock;

    private $current_unit_calculation_result;
    private $base_unit_calculation_result;
    private $current_unit_id;
    private $base_unit_id;

    public function incrementOrDecrementProductStock()
    {
        $exist = $this->checkThisProductIsExistOrNotInThisStock();
        $available_stock = 0;
        //increment stock
        if($exist) 
        {
            $this->current_available_stock      = $exist->available_stock;
            $this->current_available_base_stock = $exist->available_base_stock;
            $this->current_used_stock           = $exist->used_stock;
            $this->current_used_base_stock      = $exist->used_base_stock;
            $stock = $this->incrementStock($exist);
            $available_stock = $stock->available_stock;
            $this->current_stock_id = $stock->id;
        }
        //insert stock 
        else{
           $stock =  $this->addStockByProductId();
           $available_stock = $stock->available_stock;
           $this->current_stock_id = $stock->id;
        }
        $this->addStockHistory();
        return $available_stock;
    }


    private function calculatedCurrentStock()
    {
        $this->current_unit_calculation_result  = 0;
        $this->unitId  = $this->unit_id_forStockChangingTrait;
        $unit   = $this->getUnitByUnitId();
        if($unit['status'] == true){
            $this->current_unit_calculation_result  = $unit['unit']->calculation_result * $this->stock_quantity_forStockChangingTrait;
            $this->current_unit_id  = $this->unit_id_forStockChangingTrait;
            $this->base_unit_id     = $unit['unit']->base_unit_id;
        }
        return $this->current_unit_calculation_result;
    }

    private function calculatedBaseStock()
    {
        $baseStock = 0;
        if($this->current_unit_id == $this->base_unit_id )
        {
            $baseStock =  $this->current_unit_calculation_result;
        }
        else{
            $this->unitId  = $this->base_unit_id;
            $unit   = $this->getUnitByUnitId();
            if($unit['status'] == true){
                $baseStock  = $unit['unit']->calculation_result * $this->stock_quantity_forStockChangingTrait;
            }
        }
        return $baseStock;
    }


    private function incrementStock($stockExist)
    {
        $stockExist->available_stock        = $this->current_available_stock  + $this->calculatedCurrentStock();
        $stockExist->available_base_stock   = $this->current_available_base_stock  + $this->calculatedBaseStock();
        //$stockExist->used_stock             = $this->current_used_stock          ;
       // $stockExist->used_base_stock        = $this->current_used_base_stock     ;
       $stockExist->save();
       return $stockExist;
    }


    private function decrementStock()
    {

    }

    private function addStockByProductId()
    {
        $stock = new Stock();
        $stock->stock_type_id   = $this->stock_type_id_forStockChangingTrait;
        $stock->product_id      = $this->product_id_forStockChangingTrait;

        $stock->available_stock         = $this->calculatedCurrentStock();
        $stock->available_base_stock    = $this->calculatedBaseStock();
        $stock->used_stock              = 0;
        $stock->used_base_stock         = 0;

        $stock->sell_price      = $this->sell_price_forStockChangingTrait;
        $stock->whole_sell_price = $this->whole_sell_price_forStockChangingTrait;
        $stock->offer_price     = $this->offer_price_forStockChangingTrait;
        $stock->mrp_price       = $this->mrp_price_forStockChangingTrait;
        $stock->purchase_price  = $this->purchase_price_forStockChangingTrait;
        $stock->status = 1;
        $stock->created_by = Auth::user()->id;
        $stock->save();
        return $stock;
    }

    private function checkThisProductIsExistOrNotInThisStock()
    {
        return Stock::where('stock_type_id',$this->stock_type_id_forStockChangingTrait)
            ->where('product_id',$this->product_id_forStockChangingTrait)
            ->where('status',1)
            ->whereNull('deleted_at')
            ->first();
    }


    private function addStockHistory()
    {
        $stock = new StockHistory();
        $stock->stock_type_id           = $this->stock_type_id_forStockChangingTrait;
        $stock->stock_id                = $this->current_stock_id;
        $stock->stock_changing_type_id  = $this->stock_changing_type_id_forStockHistoryStockChangingTrait;
        $stock->stock_changing_sign     = $this->stock_changing_sign_forStockHistoryStockChangingTrait;
        $stock->stock_changing_history  = $this->stock_changing_history_forStockHistoryStockChangingTrait;
        $stock->stock                   = $this->stock_quantity_forStockChangingTrait;
        $stock->status                  = 1;
        $stock->created_by = Auth::user()->id;
        $stock->save();
        return $stock;
    }

}
