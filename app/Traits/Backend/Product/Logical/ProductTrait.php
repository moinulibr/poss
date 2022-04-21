<?php
namespace App\Traits\Backend\Product\Product\Logical;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Backend\Product\Product;
use App\Traits\Backend\FileUpload\FileUploadTrait;
use App\Setting\Backend\Product\ProductSetting;

use App\Traits\Backend\Stock\StockChangingTrait;
 /**
  * 
  */
 trait ProductTrait
 {
    use FileUploadTrait;
    use ProductSetting;
    use StockChangingTrait;
    /**
     * Its containt product mainid
     * @var integer
     */
    public int $productId;


    public function getProductByProductId()
    {
        return "ye";
        $data['status'] = false;
        if($this->unitId > 0)
        {
            $data['unit'] = Product::find($this->unitId);
            if($data['unit'])
            {
                $data['status'] = true;
            }
        }
        return $data;
    }


    /**
     * product store
     * @param array $request
     * @return void
     */
    public function productStore(array $request)
    {
        //return $this->productSetting(["imageSize",'uploadProduct',"width"]);
        //return $this->storeImage();
        //$this->dbImageField = "png";
        //return $this->imageDelete();
        
        foreach($request['form_data'] as $index => $form_index)
        {
            $product = new Product();
            $product->sku               = Str::random(10);
            $product->bacode            = Str::random(10);

            $product->supplier_id       = $request['supplier_id'];
            $product->category_id       = $request['category_id'];
            $product->sub_category_id   = $request['sub_category_id'];
            $product->brand_id          = $request['brand_id'];
            $product->product_grade_id  = $request['product_grade_id'];
            $product->unit_id           = $request['unit_id'];
            $product->supplier_group_id = $request['supplier_group_id'];

            $product->warehouse_id      = $request['warehouse_id'];
            $product->warehouse_rack_id = $request['warehouse_rack_id'];
            

            $product->custom_code = $request['custom_code_'.$form_index];
            $product->company_code = $request['company_code_'.$form_index];

            $variant = $request['product_variant_'.$form_index];
            $variant_position = $request['variant_position_'.$form_index];
            
            $product->variants = json_encode([
                "name"              => $request['name'],
                "variant"           => $variant,
                "variant_position"  => $variant_position, //befor_name, after_name
            ]);
            if($variant_position == 'befor_name')
            {
                $product->name = $variant ." ". $request['name'];
            }else{
                $product->name = $request['name']." ". $variant ;
            }

            $product->color_id = $request['color_id_'.$form_index];
            $product->purchase_price = $request['purchase_price_'.$form_index];
            $product->mrp_price = $request['mrp_price_'.$form_index];
            $product->whole_sell_price = $request['whole_sell_price_'.$form_index];
            $product->sell_price = $request['sell_price_'.$form_index];
            $product->offer_price = $request['offer_price_'.$form_index];
            $product->initial_stock = intval($request['initial_stock_'.$form_index]);
            $product->alert_stock   = intval($request['alert_stock_'.$form_index]);
            $product->description = $request['description_'.$form_index]; 
            $product->created_by = Auth::user()->id;
            $product->save();
            
            if(isset($request['photo_'.$form_index]))
            {
                $this->destination  = $this->productSetting(["imageUpload",'location',"storage_location"]);  //its mandatory;
                $this->imageWidth   = $this->productSetting(["imageSize",'uploadProduct',"width"]);  //its mandatory
                $this->imageHeight  = $this->productSetting(["imageSize",'uploadProduct',"height"]);  //its nullable
                $this->requestFile  = $request['photo_'.$form_index];  //its mandatory
                $this->id           = $product->id;
                $product->photo = $this->storeImage();
                $product->save();
            }
            //for stock history
            $this->stock_changing_type_id_forStockHistoryStockChangingTrait = 1;
            $this->stock_changing_sign_forStockHistoryStockChangingTrait = "+";
            $this->stock_changing_history_forStockHistoryStockChangingTrait = json_encode([
                'productId' => $product->id,
                'type' => 'product created time - initial stock',
                'unitId' => $product->unit_id,
                'fromStockId' => NULL,
                'fromStockName' => NULL,
                'toStockId' => NULL,
                'toStockName' => NULL,
            ]);

            $this->stock_type_id_forStockChangingTrait = 1;
            $this->product_id_forStockChangingTrait     = $product->id;
            $this->sell_price_forStockChangingTrait     = $product->sell_price;
            $this->whole_sell_price_forStockChangingTrait = $product->whole_sell_price;
            $this->offer_price_forStockChangingTrait    = $product->offer_price;
            $this->mrp_price_forStockChangingTrait      =  $product->mrp_price;
            $this->purchase_price_forStockChangingTrait = $product->purchase_price;
            $this->unit_id_forStockChangingTrait        = $product->unit_id;
            $this->stock_quantity_forStockChangingTrait = $product->initial_stock;
            $product->available_stock = $this->incrementOrDecrementProductStock();
            $product->save();
        }
        return true;
    }//product store


    /**
     * product update
     *
     * @param [type] $request
     * @return void
     */
    public function productUpdate($request)
    {
        $product =  Product::find($request['id']);
        $product->supplier_id       = $request['supplier_id'];
        $product->category_id       = $request['category_id'];
        $product->sub_category_id   = $request['sub_category_id'];
        $product->brand_id          = $request['brand_id'];
        $product->product_grade_id  = $request['product_grade_id'];
        $product->unit_id           = $request['unit_id'];
        $product->supplier_group_id = $request['supplier_group_id'];

        $product->warehouse_id      = $request['warehouse_id'];
        $product->warehouse_rack_id = $request['warehouse_rack_id'];

        $product->custom_code   = $request['custom_code'];
        $product->company_code  = $request['company_code'];

        $variant = $request['product_variant'];
        $variant_position = $request['variant_position'];
        
        $product->variants = json_encode([
            "name"              => $request['name'],
            "variant"           => $variant,
            "variant_position"  => $variant_position, //befor_name, after_name
        ]);
        if($variant_position == 'befor_name')
        {
            $product->name = $variant ." ". $request['name'];
        }else{
            $product->name = $request['name']." ". $variant ;
        }

        $product->color_id          = $request['color_id'];
        $product->purchase_price    = $request['purchase_price'];
        $product->mrp_price         = $request['mrp_price'];
        $product->whole_sell_price  = $request['whole_sell_price'];
        $product->sell_price        = $request['sell_price'];
        $product->offer_price       = $request['offer_price'];
        //$product->initial_stock     = intval($request['initial_stock']);
        $product->alert_stock       = intval($request['alert_stock']);
        $product->description       = $request['description'];
        $product->created_by        = Auth::user()->id;
        $product->save();
        
        if(isset($request['photo']))
        {
            $this->destination  = $this->productSetting(["imageUpload",'location',"storage_location"]);  //its mandatory;
            $this->imageWidth   = $this->productSetting(["imageSize",'uploadProduct',"width"]);  //its mandatory
            $this->imageHeight  = $this->productSetting(["imageSize",'uploadProduct',"height"]);  //its nullable
            $this->requestFile  = $request['photo']; //its mandatory
            $this->id           = $product->id;
            $this->dbImageField = $product->photo;  //its mandatory
            $product->photo     = $this->updateImage();
            $product->save();
        }
        return $product;
    }


    /**
     * product delete
     *
     * @param [type] $id, product id
     * @param [type] $field , product photo field
     * @return void
     */
    public function productDelete($id,$field)
    {
        $this->destination  = $this->productSetting(["imageUpload",'location',"storage_location"]);  //its mandatory;
        $this->dbImageField = $field;   //its mandatory
        $this->id           = $id;
        $this->imageDelete();
        return true;
    }



}
 



    //old product insert system, not using this
    /*
        foreach($request->form_data as $index => $form_index)
        {
            $product = new Product();
            $product->sku               = Str::random(10);
            $product->bacode            = Str::random(10);

            $product->supplier_id       = $request->supplier_id;
            $product->category_id       = $request->category_id;
            $product->sub_category_id   = $request->sub_category_id;
            $product->brand_id          = $request->brand_id;
            $product->product_grade_id  = $request->product_grade_id;
            $product->unit_id           = $request->unit_id;
            $product->supplier_group_id = $request->supplier_group_id;

            $product->custom_code = $request->input('custom_code_'.$form_index);
            $product->company_code = $request->input('company_code_'.$form_index);

            $variant = $request->input('product_variant_'.$form_index);
            $variant_position = $request->input('variant_position_'.$form_index);
            
            $product->variants = json_encode([
                "variant"           => $variant,
                "variant_position" => $variant_position, //befor_name, after_name
            ]);
            if($variant_position == 'befor_name')
            {
                $product->name = $variant ." ". $request->name;
            }else{
                $product->name = $request->name ." ". $variant ;
            }

            $product->color_id = $request->input('color_id_'.$form_index);
            $product->purchase_price = $request->input('purchase_price_'.$form_index);
            $product->mrp_price = $request->input('mrp_price_'.$form_index);
            $product->whole_sell_price = $request->input('whole_sell_price_'.$form_index);
            $product->sell_price = $request->input('sell_price_'.$form_index);
            $product->initial_stock = $request->input('initial_stock_'.$form_index);
            $product->created_by = Auth::user()->id;
            $product->save();
        }
    */