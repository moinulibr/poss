<?php
namespace App\Traits\Backend\Stock;

use App\Models\Backend\Stock\ProductStock;
use App\Models\Backend\Stock\Stock;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Stock\StockHistory;
use App\Traits\Backend\ProductAttribute\Unit\Locial\UnitTrait;


/**
 * Stock changing trait
 * 
 */
trait OldStockChangingTrait
{
    use UnitTrait;
    //fsct == for stock changing trait
    protected $stock_id_FSCT;
    protected $product_stock_id_FSCT;
    protected $product_id_FSCT;
    protected $unit_id_FSCT;
    protected $stock_quantity_FSCT;

    protected $stock_changing_type_id_FSCT;
    protected $stock_changing_sign_FSCT;
    protected $stock_changing_history_FSCT;

    private $current_stock_id;

    private $current_available_stock;
    private $current_available_base_stock;
    private $current_used_stock;
    private $current_used_base_stock;

    private $current_unit_calculation_result;
    private $base_unit_calculation_result;
    private $current_unit_id;
    private $base_unit_id;

    


    /** 1
     * initial stock as increment stock
     * when product created : 
     * increase_stock_when_product_add
     * @return void
     */
    public function initialStockTypeIncrement()
    {

    }



   
    /** 2
     * selling from poss stock type decrement
     * when selling product from poss 
     * @return void
     */
    public function sellingFromPossStockTypeDecrement()
    {

    }
    



    /** 3
     * selling return stock type increment
     * when return stock against of regular selling
     *
     * @return void
     */
    public function sellingReturnStockTypeIncrement()
    {

    }
    


    /** 4
     * regular purchase stock type increment
     * when purchase by regular process
     *
     * @return void
     */
    public function purchaseRegularStockTypeIncrement()
    {

    }
    


    /** 5
     * purchase return stock type decrement
     * return stock when purchase by regular process 
     *
     * @return void
     */
    public function purchaseReturnStockTypeDecrement()
    {

    }


    
    /** 6
     * transfer from stock type decrement
     * when transfer from this stock to another stock
     *
     * @return void
     */
    public function transferFromStockTypeDecrement()
    {

    }

    
    
    /** 7
     * transfer to stock type  increment
     * when transfered from another stock to this stock  
     *
     * @return void
     */
    public function transferToStockTypeIncrement()
    {

    }

    
    /** 8
     * damage stock as decrement stock
     * when product damage 
     *
     * @return void
     */
    public function damageStockTypeDecrement()
    {

    }




    /** 9/optional
     * adjustment stock type increment
     * stock adjust : when need to add stock
     *
     * @return void
     */
    public function adjustmentStockTypeIncrement()
    {

    }



    /** 10/optional
     * adjustment stock type decrement
     * stock adjust : when need to reduce stock
     *
     * @return void
     */
    public function adjustmentStockTypeDecrement()
    {

    }



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
        $this->unitId  = $this->unit_id_FSCT;
        $unit   = $this->getUnitByUnitId();
        if($unit['status'] == true){
            $this->current_unit_calculation_result  = $unit['unit']->calculation_result * $this->stock_quantity_FSCT;
            $this->current_unit_id  = $this->unit_id_FSCT;
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
                $baseStock  = $unit['unit']->calculation_result * $this->stock_quantity_FSCT;
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



    private function addStockByProductId()
    {
        $stock = new ProductStock();
        $stock->stock_id   = $this->stock_id_FSCT;
        $stock->product_id      = $this->product_id_FSCT;

        $stock->available_stock         = $this->calculatedCurrentStock();
        $stock->available_base_stock    = $this->calculatedBaseStock();
        $stock->used_stock              = 0;
        $stock->used_base_stock         = 0;

        $stock->status = 1;
        $stock->created_by = Auth::user()->id;
        $stock->save();
        return $stock;
    }

    private function checkThisProductIsExistOrNotInThisStock()
    {
        return Stock::where('stock_id',$this->stock_id_FSCT)
            ->where('product_id',$this->product_id_FSCT)
            ->where('status',1)
            ->whereNull('deleted_at')
            ->first();
    }


    private function addStockHistory()
    {
        $stock = new StockHistory();
        $stock->stock_id                = $this->stock_id_FSCT;
        $stock->stock_id                = $this->current_stock_id;
        $stock->stock_changing_type_id  = $this->stock_changing_type_id_FSCT;
        $stock->stock_changing_sign     = $this->stock_changing_sign_FSCT;
        $stock->stock_changing_history  = $this->stock_changing_history_FSCT;
        $stock->stock                   = $this->stock_quantity_FSCT;
        $stock->status                  = 1;
        $stock->created_by = Auth::user()->id;
        $stock->save();
        return $stock;
    }

}
