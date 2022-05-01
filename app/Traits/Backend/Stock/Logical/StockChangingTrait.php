<?php
namespace App\Traits\Backend\Stock\Logical;

use App\Models\Backend\Stock\ProductStock;
use App\Models\Backend\Stock\Stock;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Stock\StockHistory;
use App\Traits\Backend\ProductAttribute\Unit\Logical\UnitTrait;


/**
 * Stock changing trait
 * 
 */
trait StockChangingTrait
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

    private $current_available_stock_FSCT;
    private $current_available_base_stock_FSCT;
    private $current_used_stock_FSCT;
    private $current_used_base_stock_FSCT;

    private $current_unit_calculation_result_FSCT;
    private $base_unit_calculation_result_FSCT; //not using yet now
    private $current_unit_id_FSCT;
    private $base_unit_id_FSCT;

    private $stockQuantityChangingSign_FSCT;
    private $stockQuantityChangingSignStatus_FSCT;
    private $usedStockQuantityChangingSign_FSCT;
    private $usedStockQuantityChangingSignStatus_FSCT;

    private $regularStockQuantityAfterAllCalculation_FSCT;
    private $baseStockQuantityAfterAllCalculation_FSCT;

    private $authId_FSCT;
    private $authBranchId_FSCT;

    /** 1
     * initial stock as increment stock
     * when product created : 
     * increase_stock_when_product_add
     */
    public function initialStockTypeIncrement()
    {   
        $this->authId_FSCT                       = Auth::guard('web')->user()->id;
        $this->authBranchId_FSCT                 = Auth::guard('web')->user()->branch_id;
       
        //$this->stock_id_FSCT = ;
        //$this->product_id_FSCT = ;
        //$this->stock_quantity_FSCT = ;
        //$this->unit_id_FSCT = ;
        //$this->initialStockTypeIncrement();

        $this->product_stock_id_FSCT;//for history
        $this->stock_changing_type_id_FSCT = 1;//for history
        $this->stock_changing_sign_FSCT    = '+';//for history
        $this->stock_changing_history_FSCT = [];//for history

        $this->stockQuantityChangingSignStatus_FSCT = true;
        $this->stockQuantityChangingSign_FSCT = "+";
        $this->usedStockQuantityChangingSignStatus_FSCT = false;
        $this->usedStockQuantityChangingSign_FSCT = "";
        return $this->changingProductStockQuantityAsIncrementOrDecrementStock();

        //-- product_stocks
        // branch_id, stock_id,product_id,available_stock
        // available_base_stock, used_stock, used_base_stock

        //--history
        // branch_id, stock_id , product_stock_id, product_id , stock_changing_type_id
        // stock_changing_sign , stock_changing_history
        // stock
        /* [
            'productId' => $product->id,
            'type' => 'product created time - initial stock',
            'unitId' => $product->unit_id,
            'fromStockId' => NULL,
            'fromStockName' => NULL,
            'toStockId' => NULL,
            'toStockName' => NULL,
        ] */
    }



   
    /** 2
     * selling from poss stock type decrement
     * when selling product from poss 
     */
    public function sellingFromPossStockTypeDecrement()
    {
        $this->authId_FSCT                       = Auth::guard('web')->user()->id;
        $this->authBranchId_FSCT                 = Auth::guard('web')->user()->branch_id;
       
        //$this->stock_id_FSCT = ;
        //$this->product_id_FSCT = ;
        //$this->stock_quantity_FSCT = ;
        //$this->unit_id_FSCT = ;
        //$this->sellingFromPossStockTypeDecrement();

        $this->product_stock_id_FSCT;//for history
        $this->stock_changing_type_id_FSCT = 1;//for history
        $this->stock_changing_sign_FSCT    = '-';//for history
        $this->stock_changing_history_FSCT = [];//for history

        $this->stockQuantityChangingSignStatus_FSCT = true;
        $this->stockQuantityChangingSign_FSCT = "-";
        $this->usedStockQuantityChangingSignStatus_FSCT = true;
        $this->usedStockQuantityChangingSign_FSCT = "+";
        $this->changingProductStockQuantityAsIncrementOrDecrementStock();
        return true;
        //-- product_stocks
        // branch_id, stock_id,product_id,available_stock
        // available_base_stock, used_stock, used_base_stock

        //--history
        // branch_id, stock_id , product_stock_id, product_id , stock_changing_type_id
        // stock_changing_sign , stock_changing_history
        // stock
    }
    



    /** 3
     * selling return stock type increment
     * when return stock against of regular selling
     *
     */
    public function sellingReturnStockTypeIncrement()
    {
        $this->authId_FSCT                       = Auth::guard('web')->user()->id;
        $this->authBranchId_FSCT                 = Auth::guard('web')->user()->branch_id;
       
        //$this->stock_id_FSCT = ;
        //$this->product_id_FSCT = ;
        //$this->stock_quantity_FSCT = ;
        //$this->unit_id_FSCT = ;
        //$this->sellingReturnStockTypeIncrement();

        $this->product_stock_id_FSCT;//for history
        $this->stock_changing_type_id_FSCT = 1;//for history
        $this->stock_changing_sign_FSCT    = '+';//for history
        $this->stock_changing_history_FSCT = [];//for history

        $this->stockQuantityChangingSignStatus_FSCT = true;
        $this->stockQuantityChangingSign_FSCT = "+";
        $this->usedStockQuantityChangingSignStatus_FSCT = true;
        $this->usedStockQuantityChangingSign_FSCT = "-";
        $this->changingProductStockQuantityAsIncrementOrDecrementStock();
        return true;
        //-- product_stocks
        // branch_id, stock_id,product_id,available_stock
        // available_base_stock, used_stock, used_base_stock

        //--history
        // branch_id, stock_id , product_stock_id, product_id , stock_changing_type_id
        // stock_changing_sign , stock_changing_history
        // stock
    }
    


    /** 4
     * regular purchase stock type increment
     * when purchase by regular process
     *
     */
    public function purchaseRegularStockTypeIncrement()
    {
        $this->authId_FSCT                       = Auth::guard('web')->user()->id;
        $this->authBranchId_FSCT                 = Auth::guard('web')->user()->branch_id;
       
        //$this->stock_id_FSCT = ;
        //$this->product_id_FSCT = ;
        //$this->stock_quantity_FSCT = ;
        //$this->unit_id_FSCT = ;
        //$this->purchaseRegularStockTypeIncrement();

        $this->product_stock_id_FSCT;//for history
        $this->stock_changing_type_id_FSCT = 1;//for history
        $this->stock_changing_sign_FSCT    = '+';//for history
        $this->stock_changing_history_FSCT = [];//for history

        $this->stockQuantityChangingSignStatus_FSCT = true;
        $this->stockQuantityChangingSign_FSCT = "+";
        $this->usedStockQuantityChangingSignStatus_FSCT = false;
        $this->usedStockQuantityChangingSign_FSCT = "";
        $this->changingProductStockQuantityAsIncrementOrDecrementStock();
        return true;
        //-- product_stocks
        // branch_id, stock_id,product_id,available_stock
        // available_base_stock, used_stock, used_base_stock

        //--history
        // branch_id, stock_id , product_stock_id, product_id , stock_changing_type_id
        // stock_changing_sign , stock_changing_history
        // stock
    }
    


    /** 5
     * purchase return stock type decrement
     * return stock when purchase by regular process 
     *
     */
    public function purchaseReturnStockTypeDecrement()
    {
        $this->authId_FSCT                       = Auth::guard('web')->user()->id;
        $this->authBranchId_FSCT                 = Auth::guard('web')->user()->branch_id;
       
        //$this->stock_id_FSCT = ;
        //$this->product_id_FSCT = ;
        //$this->stock_quantity_FSCT = ;
        //$this->unit_id_FSCT = ;
        //$this->purchaseReturnStockTypeDecrement();

        $this->product_stock_id_FSCT;//for history
        $this->stock_changing_type_id_FSCT = 1;//for history
        $this->stock_changing_sign_FSCT    = '-';//for history
        $this->stock_changing_history_FSCT = [];//for history

        $this->stockQuantityChangingSignStatus_FSCT = true;
        $this->stockQuantityChangingSign_FSCT = "-";
        $this->usedStockQuantityChangingSignStatus_FSCT = true;
        $this->usedStockQuantityChangingSign_FSCT = "+";
        $this->changingProductStockQuantityAsIncrementOrDecrementStock();
        return true;
        //-- product_stocks
        // branch_id, stock_id,product_id,available_stock
        // available_base_stock, used_stock, used_base_stock

        //--history
        // branch_id, stock_id , product_stock_id, product_id , stock_changing_type_id
        // stock_changing_sign , stock_changing_history
        // stock
    }


    
    /** 6
     * transfer from stock type decrement
     * when transfer from this stock to another stock
     *
     */
    public function transferFromStockTypeDecrement()
    {
       
    }

    
    
    /** 7
     * transfer to stock type  increment
     * when transfered from another stock to this stock  
     *
     */
    public function transferToStockTypeIncrement()
    {

    }

    
    /** 8
     * damage stock as decrement stock
     * when product damage 
     *
     */
    public function damageStockTypeDecrement()
    {
        $this->authId_FSCT                       = Auth::guard('web')->user()->id;
        $this->authBranchId_FSCT                 = Auth::guard('web')->user()->branch_id;
       
        //$this->stock_id_FSCT = ;
        //$this->product_id_FSCT = ;
        //$this->stock_quantity_FSCT = ;
        //$this->unit_id_FSCT = ;
        //$this->transferFromStockTypeDecrement();

        $this->product_stock_id_FSCT;//for history
        $this->stock_changing_type_id_FSCT = 1;//for history
        $this->stock_changing_sign_FSCT    = '-';//for history
        $this->stock_changing_history_FSCT = [];//for history

        $this->stockQuantityChangingSignStatus_FSCT = true;
        $this->stockQuantityChangingSign_FSCT = "-";
        $this->usedStockQuantityChangingSignStatus_FSCT = true;
        $this->usedStockQuantityChangingSign_FSCT = "+";
        $this->changingProductStockQuantityAsIncrementOrDecrementStock();
        return true;
        //-- product_stocks
        // branch_id, stock_id,product_id,available_stock
        // available_base_stock, used_stock, used_base_stock

        //--history
        // branch_id, stock_id , product_stock_id, product_id , stock_changing_type_id
        // stock_changing_sign , stock_changing_history
        // stock
    }




    /** 9/optional
     * adjustment stock type increment
     * stock adjust : when need to add stock
     *
     */
    public function adjustmentStockTypeIncrement()
    {
        
    }



    /** 10/optional
     * adjustment stock type decrement
     * stock adjust : when need to reduce stock
     *
     */
    public function adjustmentStockTypeDecrement()
    {

    }





    /**
     * changing product stock quantity as increment or decrement stock
     * this method return available stock/quantity
     * 
     */
    public function changingProductStockQuantityAsIncrementOrDecrementStock()
    {
        $exist = $this->checkThisProductIsExistOrNotInThisProductStock();
        $available_stock = 0;
        //Update stock
        if($exist) 
        {
            $stock                              = $this->updateProductStockWhenStockQuantityChanging($exist);
            $available_stock                    = $stock->available_stock;
            $this->product_stock_id_FSCT        = $stock->id;
        }
        //insert stock 
        else{
           $stock                               = $this->firstTimeStoreStockInTheProductStock();
           $available_stock                     = $stock->available_stock;
           $this->product_stock_id_FSCT         = $stock->id;
        }
        $this->storeProductStockHistoryWhenStockQuantityChanging();
        return $available_stock;
    }


    /**
     * calculated unit stock by unit type
     * unit type :   regular and bass
     * @param [type] $unitType
     */
    private function calculatedUnitStockByUnitType($unitType)
    {
        $unit = 0;
        if($unitType == 'regular')
        {
            $unit = $this->getCurrentUnitStockAfterCalculation();
        }else{
            //here, again called this method for:
            //$this->base_unit_id_FSCT , $this->current_unit_calculation_result_FSCT
            $this->getCurrentUnitStockAfterCalculation();
            $unit = $this->getBaseUnitStockAfterCalculation();
        }
        return $unit;
    }

    /**
     * get calculated current unit stock 
     * regular unit stock
     * 
     */
    private function getCurrentUnitStockAfterCalculation()
    {
        $this->current_unit_calculation_result_FSCT  = 0;
        $this->unitId                           = $this->unit_id_FSCT;
        $unit                                   = $this->getUnitByUnitId();
        if($unit['status'] == true)
        {
            $this->current_unit_calculation_result_FSCT = $unit['unit']->calculation_result * $this->stock_quantity_FSCT;
            $this->current_unit_id_FSCT                 = $this->unit_id_FSCT;
            $this->base_unit_id_FSCT                    = $unit['unit']->base_unit_id;
        }
        return $this->current_unit_calculation_result_FSCT;
    }

    /**
     * get calculated base unit stock
     * base unit stock
     * 
     */
    private function getBaseUnitStockAfterCalculation()
    {
        $baseStock                  = 0;
        if($this->current_unit_id_FSCT   == $this->base_unit_id_FSCT )
        {
            $baseStock              =  $this->current_unit_calculation_result_FSCT;
        }
        else{
            $this->unitId           = $this->base_unit_id_FSCT;
            $unit                   = $this->getUnitByUnitId();
            if($unit['status']      == true)
            {
                $baseStock          = $unit['unit']->calculation_result * $this->stock_quantity_FSCT;
            }
        }
        return $baseStock;
    }


    /**
     * Update product stock when stock quantity change
     *
     * @param [type] $stockExist
     */
    private function updateProductStockWhenStockQuantityChanging($stockExist)
    {
        $this->current_available_stock_FSCT      = $stockExist->available_stock;
        $this->current_available_base_stock_FSCT = $stockExist->available_base_stock;
        $this->current_used_stock_FSCT           = $stockExist->used_stock;
        $this->current_used_base_stock_FSCT      = $stockExist->used_base_stock;
        
        $this->regularStockQuantityAfterAllCalculation_FSCT   = $this->calculatedUnitStockByUnitType('regular');
        $this->baseStockQuantityAfterAllCalculation_FSCT      = $this->calculatedUnitStockByUnitType('base');

        //for regular stock
        if($this->stockQuantityChangingSign_FSCT == "+" && 
            $this->stockQuantityChangingSignStatus_FSCT == true
        )
        {
            $available_stock                = $this->current_available_stock_FSCT        + $this->regularStockQuantityAfterAllCalculation_FSCT;
            $available_base_stock           = $this->current_available_base_stock_FSCT   + $this->baseStockQuantityAfterAllCalculation_FSCT ;
        }
        else if($this->stockQuantityChangingSign_FSCT == "-" &&
            $this->stockQuantityChangingSignStatus_FSCT == true
        )
        {
            $available_stock                = $this->current_available_stock_FSCT        - $this->regularStockQuantityAfterAllCalculation_FSCT;
            $available_base_stock           = $this->current_available_base_stock_FSCT   - $this->baseStockQuantityAfterAllCalculation_FSCT ;
        }else{
            $available_stock                = $this->current_available_stock_FSCT;
            $available_base_stock           = $this->current_available_base_stock_FSCT;
        }

        //for used stock
        if($this->usedStockQuantityChangingSign_FSCT == "+" &&
            $this->usedStockQuantityChangingSignStatus_FSCT == true
        )
        {
            $used_stock                     = $this->current_used_stock_FSCT             + $this->regularStockQuantityAfterAllCalculation_FSCT;
            $used_base_stock                = $this->current_used_base_stock_FSCT        + $this->baseStockQuantityAfterAllCalculation_FSCT ;
        }
        else if($this->usedStockQuantityChangingSign_FSCT == "-" && 
            $this->usedStockQuantityChangingSignStatus_FSCT == true
        )
        {
            $used_stock                     = $this->current_used_stock_FSCT             - $this->regularStockQuantityAfterAllCalculation_FSCT;
            $used_base_stock                = $this->current_used_base_stock_FSCT        - $this->baseStockQuantityAfterAllCalculation_FSCT ;
        }else{
            $used_stock                     = $this->current_used_stock_FSCT;
            $used_base_stock                = $this->current_used_base_stock_FSCT;
        }

        $stockExist->available_stock        = $available_stock;
        $stockExist->available_base_stock   = $available_base_stock;
        $stockExist->used_stock             = $used_stock;
        $stockExist->used_base_stock        = $used_base_stock;
        $stockExist->save();
        return $stockExist;
    }



    /**
     * first time add/store stock in the product stock table
     * when product create or purchase product
     */
    private function firstTimeStoreStockInTheProductStock()
    {
        $stock = new ProductStock();
        $stock->stock_id                = $this->stock_id_FSCT;
        $stock->product_id              = $this->product_id_FSCT;

        $stock->available_stock         = $this->calculatedUnitStockByUnitType('regular');
        $stock->available_base_stock    = $this->calculatedUnitStockByUnitType('base');
        $stock->used_stock              = 0;
        $stock->used_base_stock         = 0;

        $stock->status                  = 1;
        $stock->branch_id               = $this->authBranchId_FSCT;
        $stock->created_by              = $this->authId_FSCT;
        $stock->save();
        return $stock;
    }


    /**
     * check this product is exist or not in this product stock
     * just check here , when first time stock initial in product stock 
     * 
     */
    private function checkThisProductIsExistOrNotInThisProductStock()
    {
        return ProductStock::where('stock_id',$this->stock_id_FSCT)
        ->where('branch_id',$this->authBranchId_FSCT)
        ->where('product_id',$this->product_id_FSCT)
        ->where('status',1)
        ->whereNull('deleted_at')
        ->first();
    }

    /**
     * add stock history
     * when changing stock (product_stocks), then store in as history
     */
    private function storeProductStockHistoryWhenStockQuantityChanging()
    {   
        $stock = new StockHistory();
        $stock->stock_id                = $this->stock_id_FSCT;
        $stock->product_stock_id        = $this->product_stock_id_FSCT;
        $stock->product_id              = $this->product_id_FSCT;
        $stock->stock_changing_type_id  = $this->stock_changing_type_id_FSCT;
        $stock->stock_changing_sign     = $this->stock_changing_sign_FSCT;
        $stock->stock_changing_history  = json_encode( $this->stock_changing_history_FSCT);
        $stock->stock                   = $this->stock_quantity_FSCT;
        $stock->status                  = 1;
        $stock->branch_id               = $this->authBranchId_FSCT;
        $stock->created_by              = $this->authId_FSCT;
        $stock->save();
        return $stock;
        // branch_id, stock_id , product_stock_id, product_id , stock_changing_type_id
        // stock_changing_sign , stock_changing_history
        // stock
    }





}
