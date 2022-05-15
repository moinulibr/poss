<?php

namespace App\Http\Controllers\Backend\Sell\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

use App\Models\Backend\Price\Price;
use App\Models\Backend\Stock\Stock;

//use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Traits\Permission\Permission;
use App\Models\Backend\Product\Product;
use App\Models\Backend\Supplier\Supplier;
use App\Models\Backend\Price\ProductPrice;
use App\Models\Backend\Stock\ProductStock;
use App\Models\Backend\Warehouse\Warehouse;
use App\Models\Backend\ProductAttribute\Unit;
use App\Models\Backend\ProductAttribute\Brand;
use App\Models\Backend\ProductAttribute\Color;
use App\Models\Backend\Supplier\SupplierGroup;
use App\Models\Backend\ProductAttribute\Category;
use App\Models\Backend\ProductAttribute\SubCategory;
use App\Traits\Backend\Product\Logical\ProductTrait;
use App\Models\Backend\ProductAttribute\ProductGrade;
use App\Traits\Backend\Product\Request\ProductValidationTrait;
class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayProductList(Request $request)
    {
        $query = Product::query();
        if($request->product_id){
            $query->where('id',$request->product_id);
        }
        if($request->category_id){
            $query->where('category_id',$request->category_id);
        }
        if($request->custom_search){
            $query->where('name','like',"%".$request->custom_search."%");
            $query->orWhere('custom_code','like',"%".$request->custom_search."%");
            $query->orWhere('company_code','like',"%".$request->custom_search."%");
            $query->orWhere('sku','like',"%".$request->custom_search."%");
        }
        $data['products']       = $query->select('name','id','photo')
                                ->latest()
                                ->paginate(15);
        $view = view('backend.sell.pos.ajax-response.landing.product-list.product_list',$data)->render();
        return response()->json([
            'status'    => true,
            'html'      => $view,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories']     = Category::latest()->get();
        $data['brands']         = Brand::latest()->get();
        $data['colors']         = Color::latest()->get();
        $data['suppliers']      = Supplier::latest()->get();
        $data['productGrades']  = ProductGrade::latest()->get();
        $data['supplierGroups'] = SupplierGroup::latest()->get();
        $data['units']          = Unit::latest()->get();

        $data['warehouses']     = Warehouse::latest()->get();

        $data['prices']         = Price::where('status',1)
                                ->where('branch_id',authBranch_hh())
                                ->whereNull('deleted_at')
                                ->orderBy('custom_serial','ASC')
                                ->get();
        $data['allproducts']    = Product::select('name','id')->latest()->get();
        $data['products']       = Product::select('name','id','photo')
                                ->latest()
                                ->paginate(15);
        return view('backend.sell.pos.landing.create_pos',$data);
        return view('backend.sell.pos.zdesign.design_single_product',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function singleProductDetails(Request $request)
    {
        $data['categories']     = Category::latest()->get();
        $data['brands']         = Brand::latest()->get();
        $data['colors']         = Color::latest()->get();
        $data['suppliers']      = Supplier::latest()->get();
        $data['productGrades']  = ProductGrade::latest()->get();
        $data['supplierGroups'] = SupplierGroup::latest()->get();
        $data['units']          = Unit::latest()->get();

        $data['warehouses']     = Warehouse::latest()->get();

        $data['prices']         = Price::where('status',1)
                                ->where('branch_id',authBranch_hh())
                                ->whereNull('deleted_at')
                                ->orderBy('custom_serial','ASC')
                                ->get();
        $data['product']       = Product::find($request->id);
        $view = view('backend.sell.pos.ajax-response.single-product.single_product',$data)->render();
        $stock = view('backend.sell.pos.ajax-response.single-product.include.product_stock',$data)->render();
        return response()->json([
            'status'    => true,
            'html'      => $view,
            'stock'     => $stock,
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
