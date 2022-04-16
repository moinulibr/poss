<?php

namespace App\Http\Controllers\Backend\Product;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Traits\Permission\Permission;

//use Illuminate\Support\Facades\Validator;

use App\Models\Backend\Product\Product;
use App\Models\Backend\Supplier\Supplier;
use App\Models\Backend\ProductAttribute\Unit;
use App\Models\Backend\ProductAttribute\Brand;
use App\Models\Backend\ProductAttribute\Color;
use App\Models\Backend\Supplier\SupplierGroup;
use App\Models\Backend\ProductAttribute\Category;
use App\Models\Backend\ProductAttribute\SubCategory;
use App\Models\Backend\ProductAttribute\ProductGrade;
use App\Http\Requests\Backend\Product\ProductValidationTrait;
use App\Models\Backend\Warehouse\Warehouse;
use App\Traits\Backend\Product\Product\ProductTrait;
class ProductController extends Controller
{
    use ProductValidationTrait;
    use ProductTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['colors'] = Color::latest()->get();
        $data['datas']  = Product::latest()->paginate(50);
        return view('backend.product.product.index',$data);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function productListByAjaxResponse(Request $request)
    {
        $data['colors'] = Color::latest()->get();
        $product  = Product::query();
        if($request->ajax())
        {
            if($request->search)
            {
                $product->where('name','like','%'.$request->search.'%')
                        ->orWhere('sku','like','%'.$request->search.'%')
                        ->orWhere('bacode','like','%'.$request->search.'%')
                        ->orWhere('custom_code','like','%'.$request->search.'%')
                        ->orWhere('company_code','like','%'.$request->search.'%');
            }
            $data['datas']  =  $product->latest()->paginate(50);
            $html = view('backend.product.product.ajax.list_ajax_response',$data)->render();
            return response()->json([
                'status' => true,
                'html' => $html
            ]);
        }
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
        return view('backend.product.product.create',$data);
        return view('backend.pos.create',$data);
        //return view('backend.product.product.old_create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validators = $this->productValidationWhenStoreProduct($request->all());
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }

        $this->productStore($request->all());
      
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Product added successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,Request $request)
    {
        $data['product'] = Product::findOrFail($request->id);
        return view('backend.product.product.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,Request $request)
    {
        $data['categories']     = Category::latest()->get();
        $data['brands']         = Brand::latest()->get();
        $data['colors']         = Color::latest()->get();
        $data['suppliers']      = Supplier::latest()->get();
        $data['productGrades']  = ProductGrade::latest()->get();
        $data['supplierGroups'] = SupplierGroup::latest()->get();
        $data['units']          = Unit::latest()->get();
        $data['warehouses']     = Warehouse::latest()->get();

        $data['product'] = Product::findOrFail($request->id);
        return view('backend.product.product.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validators = $this->productValidationWhenUpdateProduct($request->all(),$request->id);
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }

        $this->productUpdate($request->all());

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Product updated successfully"
        ]);
    }


    
    public function delete(Product $product, Request $request)
    {
        //for solf delete, photo not deleting
        //$item = Product::findOrFail($request->id)->delete();
        /* if($item->photo){
            $this->productDelete($request->id,$item->photo);
        }
        $item->delete(); */
        
        $item = Product::findOrFail($request->id)->delete();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Product Deleted successfully"
        ]);
    } 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
