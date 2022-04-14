{{-- <link rel="stylesheet" href="{{asset('custom_css/backend')}}/only_for_product_show_modal.css">--}}

<div class="modal-dialog modal-lg">
    <div  class=" modal-content">

        <div class="modal-header">
            <h5 class="modal-title">
                Product  
                <span class="font-weight-light">Information</span>
                <br />
                {{-- <small class="text-muted">Add New Reference</small> --}}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
        </div>
        <div class="modal-body">

            

                <div class="card" style="margin-top:0px;margin-bottom:0px;padding: 10px;">
                    <div class="container-fliud">
                        <div class="wrapper row">
                            <div class="preview col-md-6"> 
                                <div class="" style="margin-bottom:20px;">
                                  <div class="tab-pane active" id="pic-1">
                                        {{-- @if(Storage::disk('public')->exists("storage/backend/product/product/{$item->id}.",$item->photo)) --}}
                                        @if($product->photo)
                                        <img src="{{ asset('storage/backend/product/product/'.$product->id.".".$product->photo) }}" width="100%" height="195;" style="padding:4px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px" />
                                            @else
                                            <img src="{{ asset('storage/backend/default/product/5.png') }}" width="100%" height="195;" style="padding:4px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px" />
                                        @endif
                                    </div>
                                </div>
                            </div><!---col-6-->
                            <div class="details col-md-6">
                                <h5 class="product-title">{{$product->name}}</h5>
                                <!--  
                                    <div class="rating">
                                        <div class="stars">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                        <span class="review-no">41 reviews</span>
                                    </div> 
                                -->
                                <div style="border-bottom:1px solid rgba(24,28,33,.06);padding:5px;margin-bottom:10px;"></div>
                                
                                <h6 class="price"><span style="color:orange"> Purchase price </span> : <span style="background-color:#e3e3f3;padding:2px;">{{$product->sell_price}}</span></h6>
                                <h6 class="price"><span style="color:blue"> MRP price </span> : <span style="background-color:#e3e3f3;padding:2px;">{{$product->mrp_price}}</span></h6>
                                <h6 class="price"><span style="color:green"> Whole Sell price </span> : <span style="background-color:#e3e3f3;padding:2px;">{{$product->whole_sell_price}}</span></h6>
                                <h6 class="price"><span style="color:blue"> Sell price </span> : <span style="background-color:#e3e3f3;padding:2px;">{{$product->sell_price}}</span></h6>
                                <h6 class="price"><span style="color:#286e2d"> Offer price </span> : <span style="background-color:#e3e3f3;padding:2px;">{{$product->offer_price}}</span></h6>
                                
                                <!-- 
                                    <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
                                    <h5 class="sizes">sizes:
                                        <span class="size" data-toggle="tooltip" title="small">s</span>
                                        <span class="size" data-toggle="tooltip" title="medium">m</span>
                                        <span class="size" data-toggle="tooltip" title="large">l</span>
                                        <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
                                    </h5>
                                    <h5 class="colors">colors:
                                        <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
                                        <span class="color green"></span>
                                        <span class="color blue"></span>
                                    </h5>
                                    <div class="action">
                                        <button class="add-to-cart btn btn-default" type="button">add to cart</button>
                                        <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                                    </div> 
                                -->
                            </div><!---col-6-->


                          
                        </div><!---wrapper row--->
                        



                        <div style="border-bottom:1px solid rgba(24,28,33,.06);padding:5px;margin-bottom:10px;"></div>
                            
                        <div class="wrapper row">
                            <div class="col-md-6">
                                <div>
                                    <table class="table" style="border:none;border-right:1px solid rgba(24,28,33,.06)">
                                        <thead>
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    AS Code
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->custom_code }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    Company Code
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->company_code }}
                                                </th>
                                            </tr>
                                           
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    SKU
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->sku }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    Barcode
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->bacode }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    Status
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    @if (!$product->deleted_at)
                                                        <span class="badge badge-success">Active</span>
                                                        @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    Initial Stock
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->initial_stock }}
                                                </th>
                                            </tr> 
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    Alert Quantity
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->alert_stock }}
                                                </th>
                                            </tr> 
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    Available Stock
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->available_stock }}
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <table class="table" style="border:none;">
                                        <thead>
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    Supplier
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->suppliers ? $product->suppliers->name : null }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    Category
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->categories ? $product->categories->name : null }}
                                                </th>
                                            </tr>
                                            @if ($product->sub_category_id)
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    Sub-category
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->subCategories ? $product->subCategories->name : null }}
                                                </th>
                                            </tr>
                                            @endif
                                            @if ($product->color_id)    
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    Color
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->colors ? $product->colors->name : null }}
                                                </th>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    Grade
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->productGrades ? $product->productGrades->name : null }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    Unit
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->units ? $product->units->full_name : null }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    Brand
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->brands ? $product->brands->name : null }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="width:20%;border:none;">
                                                    Warehouse
                                                </th>
                                                <td style="width:1%;border:none;">:</td>
                                                <th style="border:none;">
                                                    {{$product->warehouses ? $product->warehouses->name : 'Default Warehouse' }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="width:20%;border:none;" colspan="3">
                                                    Rack/Sefl : {{$product->warehouseRacks ? $product->warehouseRacks->name : "Default Rack/Self" }}
                                                </th>
                                               
                                            </tr>
                                        </thead>
                                    </table>
                                    {{-- <div>
                                        <strong>Supplier</strong> : <span>{{$product->suppliers ? $product->suppliers->name : null }}</span>
                                    </div>
                                    <div>
                                        <strong>Category</strong> : <span>{{$product->categories ? $product->categories->name : null }}</span>
                                    </div>
                                    @if ($product->sub_category_id)    
                                    <div>
                                        <strong>Sub-category</strong> : <span>{{$product->subCategories ? $product->subCategories->name : null }}</span>
                                    </div>    
                                    @endif
                                    @if ($product->color_id)    
                                    <div>
                                        <strong>Color</strong> : <span>{{$product->colors ? $product->colors->name : null }}</span>
                                    </div>
                                    @endif
                                    <div>
                                        <strong>Grade</strong> : <span>{{$product->productGrades ? $product->productGrades->name : null }}</span>
                                    </div>
                                    <div>
                                        <strong>Unit</strong> : <span>{{$product->units ? $product->units->full_name : null }}</span>
                                    </div> --}}

                                </div>
                            </div>
                        </div><!---wrapper row--->


                        <div style="border-bottom:1px solid rgba(24,28,33,.06);padding:5px;margin-bottom:10px;"></div>
                            

                        <div class="wrapper row">
                            <div class="col-md-12">
                                <strong style="border-bottom:1px solid gray;padding-bottom:5px;">Description</strong><br/>
                                <p class="product-description" style="margin-top:5px;">
                                    {{$product->description}}
                                </p>
                            </div>
                        </div><!---wrapper row--->


                    </div><!---container-fliud---->
                </div>
                <!---card---->



        </div>
        
     
        
        
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>