<?php

namespace App\Models\Backend\Product;

use App\Models\Backend\ProductAttribute\Brand;
use App\Models\Backend\ProductAttribute\Category;
use App\Models\Backend\ProductAttribute\Color;
use App\Models\Backend\ProductAttribute\ProductGrade;
use App\Models\Backend\ProductAttribute\SubCategory;
use App\Models\Backend\ProductAttribute\Unit;
use App\Models\Backend\Supplier\Supplier;
use App\Models\Backend\Warehouse\Warehouse;
use App\Models\Backend\Warehouse\WarehouseRack;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    

    public function brands()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function subCategories()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }

    public function colors()
    {
        return $this->belongsTo(Color::class,'color_id','id');
    }

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }

    public function productGrades()
    {
        return $this->belongsTo(ProductGrade::class,'product_grade_id','id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class,'unit_id','id');
    }

    public function warehouses()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }

    public function warehouseRacks()
    {
        return $this->belongsTo(WarehouseRack::class,'warehouse_rack_id','id');
    }


}
