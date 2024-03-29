<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('clear', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('storage:link');
    return 'DONE'; //Return anything
});
Route::get('/', 'Landing\LandingController@index')->name('landing');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/test', 'HomeController@test')->name('test');






#,'routeCheck'
Route::group(['middleware' => ['auth']], function ()
{

    /*
    |----------------------------------------
    |   prodct attribute : Unit  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */
        Route::group(['as'=> 'admin.unit.', 'prefix'=>'admin/unit','namespace'=>'Backend\ProductAttribute'],function(){
            Route::get('list','UnitController@index')->name('index');//;//->middleware(['permissions:unit|index']);
            Route::get('list/by/ajr','UnitController@unitListByAjaxResponse')->name('list.ajaxresponse');//;//->middleware(['permissions:unit|index']);
            Route::get('create','UnitController@create')->name('create');//->middleware(['permissions:unit|index']);
            Route::post('store','UnitController@store')->name('store');//->middleware(['permissions:unit|index']);

            Route::get('edit','UnitController@edit')->name('edit');//->middleware(['permissions:unit|index']);
            Route::post('update','UnitController@update')->name('update');//->middleware(['permissions:unit|index']);
        
            Route::get('delete','UnitController@delete')->name('delete');//->middleware(['permissions:unit|index']);
        });
    /*
    |----------------------------------------
    |   prodct attribute : Unit  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */

    /*
    |----------------------------------------
    |   prodct attribute : Category  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */
        Route::group(['as'=> 'admin.category.', 'prefix'=>'admin/category','namespace'=>'Backend\ProductAttribute'],function(){
            Route::get('list','CategoryController@index')->name('index');//->middleware(['permissions:unit|index']);
            Route::get('list/by/ajr','CategoryController@categoryListByAjaxResponse')->name('list.ajaxresponse');//->middleware(['permissions:unit|index']);
            Route::get('create','CategoryController@create')->name('create');//->middleware(['permissions:unit|index']);
            Route::post('store','CategoryController@store')->name('store');//->middleware(['permissions:unit|index']);

            Route::get('edit','CategoryController@edit')->name('edit');//->middleware(['permissions:unit|index']);
            Route::post('update','CategoryController@update')->name('update');//->middleware(['permissions:unit|index']);
        
            Route::get('delete','CategoryController@delete')->name('delete');//->middleware(['permissions:unit|index']);
        });
    /*
    |----------------------------------------
    |   prodct attribute : Category  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */

    /*
    |----------------------------------------
    |   prodct attribute : SubCategory  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */
        Route::group(['as'=> 'admin.subcategory.', 'prefix'=>'admin/sub/category','namespace'=>'Backend\ProductAttribute'],function(){
            Route::get('list','SubCategoryController@index')->name('index');//->middleware(['permissions:unit|index']);
            Route::get('list/by/ajr','SubCategoryController@subCategoryListByAjaxResponse')->name('list.ajaxresponse');//->middleware(['permissions:unit|index']);
            Route::get('create','SubCategoryController@create')->name('create');//->middleware(['permissions:unit|index']);
            Route::post('store','SubCategoryController@store')->name('store');//->middleware(['permissions:unit|index']);

            Route::get('edit','SubCategoryController@edit')->name('edit');//->middleware(['permissions:unit|index']);
            Route::post('update','SubCategoryController@update')->name('update');//->middleware(['permissions:unit|index']);
        
            Route::get('delete','SubCategoryController@delete')->name('delete');//->middleware(['permissions:unit|index']);
        

            //sub category by category id
            Route::get('category/id','SubCategoryController@subCategoryByCategoryId')->name('by.category.id');//->middleware(['permissions:unit|index']);
        });
    /*
    |----------------------------------------
    |   prodct attribute : SubCategory  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */

    /*
    |----------------------------------------
    |   prodct attribute : Brand  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */
        Route::group(['as'=> 'admin.brand.', 'prefix'=>'admin/brand','namespace'=>'Backend\ProductAttribute'],function(){
            Route::get('list','BrandController@index')->name('index');//->middleware(['permissions:unit|index']);
            Route::get('list/by/ajr','BrandController@brandListByAjaxResponse')->name('list.ajaxresponse');//->middleware(['permissions:unit|index']);
            Route::get('create','BrandController@create')->name('create');//->middleware(['permissions:unit|index']);
            Route::post('store','BrandController@store')->name('store');//->middleware(['permissions:unit|index']);

            Route::get('edit','BrandController@edit')->name('edit');//->middleware(['permissions:unit|index']);
            Route::post('update','BrandController@update')->name('update');//->middleware(['permissions:unit|index']);
        
            Route::get('delete','BrandController@delete')->name('delete');//->middleware(['permissions:unit|index']);
        });
    /*
    |----------------------------------------
    |   prodct attribute : Brand  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */

    /*
    |----------------------------------------
    |   prodct attribute : Color  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */
        Route::group(['as'=> 'admin.color.', 'prefix'=>'admin/color','namespace'=>'Backend\ProductAttribute'],function(){
            Route::get('list','ColorController@index')->name('index');//->middleware(['permissions:unit|index']);
            Route::get('list/by/ajr','ColorController@colorListByAjaxResponse')->name('list.ajaxresponse');//->middleware(['permissions:unit|index']);
            Route::get('create','ColorController@create')->name('create');//->middleware(['permissions:unit|index']);
            Route::post('store','ColorController@store')->name('store');//->middleware(['permissions:unit|index']);

            Route::get('edit','ColorController@edit')->name('edit');//->middleware(['permissions:unit|index']);
            Route::post('update','ColorController@update')->name('update');//->middleware(['permissions:unit|index']);
        
            Route::get('delete','ColorController@delete')->name('delete');//->middleware(['permissions:unit|index']);
        });
    /*
    |----------------------------------------
    |   prodct attribute : Color  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */


    /*
    |----------------------------------------
    |   prodct attribute : Product grade  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */
        Route::group(['as'=> 'admin.product.grade.', 'prefix'=>'admin/product/grade','namespace'=>'Backend\ProductAttribute'],function(){
            Route::get('list','ProductGradeController@index')->name('index');//->middleware(['permissions:unit|index']);
            Route::get('list/by/ajr','ProductGradeController@productGradeListByAjaxResponse')->name('list.ajaxresponse');//->middleware(['permissions:unit|index']);
            Route::get('create','ProductGradeController@create')->name('create');//->middleware(['permissions:unit|index']);
            Route::post('store','ProductGradeController@store')->name('store');//->middleware(['permissions:unit|index']);

            Route::get('edit','ProductGradeController@edit')->name('edit');//->middleware(['permissions:unit|index']);
            Route::post('update','ProductGradeController@update')->name('update');//->middleware(['permissions:unit|index']);
        
            Route::get('delete','ProductGradeController@delete')->name('delete');//->middleware(['permissions:unit|index']);
        });
    /*
    |----------------------------------------
    |   prodct attribute : Product grade  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */


    /*
    |----------------------------------------
    |   prodct attribute : Supplier Group  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */
        Route::group(['as'=> 'admin.supplier.group.', 'prefix'=>'admin/supplier/group','namespace'=>'Backend\Supplier'],function(){
            Route::get('list','SupplierGroupController@index')->name('index');//->middleware(['permissions:unit|index']);
            Route::get('list/by/ajr','SupplierGroupController@supplierGroupListByAjaxResponse')->name('list.ajaxresponse');//->middleware(['permissions:unit|index']);
            Route::get('create','SupplierGroupController@create')->name('create');//->middleware(['permissions:unit|index']);
            Route::post('store','SupplierGroupController@store')->name('store');//->middleware(['permissions:unit|index']);

            Route::get('edit','SupplierGroupController@edit')->name('edit');//->middleware(['permissions:unit|index']);
            Route::post('update','SupplierGroupController@update')->name('update');//->middleware(['permissions:unit|index']);
        
            Route::get('delete','SupplierGroupController@delete')->name('delete');//->middleware(['permissions:unit|index']);
        });
    /*
    |----------------------------------------
    |   prodct attribute : Supplier Group  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */

    /*
    |----------------------------------------
    |   Supplier  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */
        Route::group(['as'=> 'admin.supplier.', 'prefix'=>'admin/supplier','namespace'=>'Backend\Supplier'],function(){
            Route::get('list','SupplierController@index')->name('index');//->middleware(['permissions:unit|index']);
            Route::get('list/by/ajr','SupplierController@supplierListByAjaxResponse')->name('list.ajaxresponse');//->middleware(['permissions:unit|index']);
            Route::get('create','SupplierController@create')->name('create');//->middleware(['permissions:unit|index']);
            Route::post('store','SupplierController@store')->name('store');//->middleware(['permissions:unit|index']);

            Route::get('edit','SupplierController@edit')->name('edit');//->middleware(['permissions:unit|index']);
            Route::post('update','SupplierController@update')->name('update');//->middleware(['permissions:unit|index']);
        
            Route::get('delete','SupplierController@delete')->name('delete');//->middleware(['permissions:unit|index']);
        });
    /*
    |----------------------------------------
    |   Supplier  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */

    /*
    |----------------------------------------
    |   Customer  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */
        Route::group(['as'=> 'admin.customer.', 'prefix'=>'admin/customer','namespace'=>'Backend\Customer'],function(){
            Route::get('list','CustomerController@index')->name('index');//->middleware(['permissions:unit|index']);
            Route::get('list/by/ajr','CustomerController@customerListByAjaxResponse')->name('list.ajaxresponse');//->middleware(['permissions:unit|index']);
            Route::get('create','CustomerController@create')->name('create');//->middleware(['permissions:unit|index']);
            Route::post('store','CustomerController@store')->name('store');//->middleware(['permissions:unit|index']);

            Route::get('edit','CustomerController@edit')->name('edit');//->middleware(['permissions:unit|index']);
            Route::post('update','CustomerController@update')->name('update');//->middleware(['permissions:unit|index']);
        
            Route::get('delete','CustomerController@delete')->name('delete');//->middleware(['permissions:unit|index']);
        });
    /*
    |----------------------------------------
    |   Customer  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */

        
    /*
    |----------------------------------------
    |   Reference  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */
        Route::group(['as'=> 'admin.reference.', 'prefix'=>'admin/reference','namespace'=>'Backend\Reference'],function(){
            Route::get('list','ReferenceController@index')->name('index');//->middleware(['permissions:unit|index']);
            Route::get('list/by/ajr','ReferenceController@referenceListByAjaxResponse')->name('list.ajaxresponse');//->middleware(['permissions:unit|index']);
            Route::get('create','ReferenceController@create')->name('create');//->middleware(['permissions:unit|index']);
            Route::post('store','ReferenceController@store')->name('store');//->middleware(['permissions:unit|index']);

            Route::get('edit','ReferenceController@edit')->name('edit');//->middleware(['permissions:unit|index']);
            Route::post('update','ReferenceController@update')->name('update');//->middleware(['permissions:unit|index']);
        
            Route::get('delete','ReferenceController@delete')->name('delete');//->middleware(['permissions:unit|index']);
        });        
    /*
    |----------------------------------------
    |   Reference  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */



        
    /*
    |----------------------------------------
    |   prodct attribute : warehouse  
    |---------------------------------------
    */
        Route::group(['as'=> 'admin.warehouse.', 'prefix'=>'admin/warehouse','namespace'=>'Backend\Warehouse'],function(){
            Route::get('list','WarehouseController@index')->name('index');//->middleware(['permissions:unit|index']);
            Route::get('list/by/ajr','WarehouseController@warehouseListByAjaxResponse')->name('list.ajaxresponse');//->middleware(['permissions:unit|index']);
            Route::get('create','WarehouseController@create')->name('create');//->middleware(['permissions:unit|index']);
            Route::post('store','WarehouseController@store')->name('store');//->middleware(['permissions:unit|index']);

            Route::get('edit','WarehouseController@edit')->name('edit');//->middleware(['permissions:unit|index']);
            Route::post('update','WarehouseController@update')->name('update');//->middleware(['permissions:unit|index']);
        
            Route::get('delete','WarehouseController@delete')->name('delete');//->middleware(['permissions:unit|index']);
        });
    /*
    |----------------------------------------
    |   prodct attribute : warehouse  
    |---------------------------------------
    */

    /*
    |----------------------------------------
    |   prodct attribute : SubCategory  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */
        Route::group(['as'=> 'admin.warehouse.rack.', 'prefix'=>'admin/warehouse/rack','namespace'=>'Backend\Warehouse'],function(){
            Route::get('list','WarehouseRackController@index')->name('index');//->middleware(['permissions:unit|index']);
            Route::get('list/by/ajr','WarehouseRackController@warehouseRackListByAjaxResponse')->name('list.ajaxresponse');//->middleware(['permissions:unit|index']);
            Route::get('create','WarehouseRackController@create')->name('create');//->middleware(['permissions:unit|index']);
            Route::post('store','WarehouseRackController@store')->name('store');//->middleware(['permissions:unit|index']);

            Route::get('edit','WarehouseRackController@edit')->name('edit');//->middleware(['permissions:unit|index']);
            Route::post('update','WarehouseRackController@update')->name('update');//->middleware(['permissions:unit|index']);
        
            Route::get('delete','WarehouseRackController@delete')->name('delete');//->middleware(['permissions:unit|index']);
        

            //warehouse rack by warehouse id
            Route::get('warehouse/id','WarehouseRackController@warehouseRackByWarehouseId')->name('by.warehouse.id');//->middleware(['permissions:unit|index']);
        });
    /*
    |----------------------------------------
    |   prodct attribute : SubCategory  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */



    /*
    |----------------------------------------
    |   Product  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */
        Route::group(['as'=> 'admin.product.', 'prefix'=>'admin/product','namespace'=>'Backend\Product'],function(){
            Route::get('list','ProductController@index')->name('index');//->middleware(['permissions:unit|index']);
            Route::get('list/by/ajr','ProductController@productListByAjaxResponse')->name('list.ajaxresponse');//->middleware(['permissions:unit|index']);
            Route::get('create','ProductController@create')->name('create');//->middleware(['permissions:unit|index']);
            Route::post('store','ProductController@store')->name('store');//->middleware(['permissions:unit|index']);

            Route::get('show','ProductController@show')->name('show');//->middleware(['permissions:unit|index']);
            
            Route::get('edit','ProductController@edit')->name('edit');//->middleware(['permissions:unit|index']);
            Route::post('update','ProductController@update')->name('update');//->middleware(['permissions:unit|index']);
        
            Route::get('delete','ProductController@delete')->name('delete');//->middleware(['permissions:unit|index']);
            
            //product price
            Route::get('price/update','ProductPriceController@index')->name('price.index');//->middleware(['permissions:unit|index']);
            Route::post('price/updating','ProductPriceController@store')->name('price.store');//->middleware(['permissions:unit|index']);
        });
    /*
    |----------------------------------------
    |   Product  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */


    /*
    |----------------------------------------
    |  session setting (sell)
    |---------------------------------------
    */
        Route::group(['prefix'=>'admin/session/setting','as'=> 'admin.session.','namespace'=>'Backend\Session'],function(){
            Route::post('creating/selling/new/cart/session','SessionController@creatingSellingCartSession')->name('setting.create.selling.new.session');
            Route::get('changing/selling/cart/{sessionname?}','SessionController@changingSellingCartSession')->name('changing.selling.cart.session');
            Route::get('delete/selling/customer/name/{sessionname?}','SessionController@deleteingSellingCartSession')->name('deleting.selling.cart.session');
        });   
    /*
    |----------------------------------------
    |  session setting (sell)
    |---------------------------------------
    */


    /*
    |----------------------------------------
    |   Sell  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */
        Route::group(['as'=> 'admin.sell.regular.pos.', 'prefix'=>'admin/regular/sell','namespace'=>'Backend\Sell\Pos'],function(){
            Route::get('display/product/list','PosController@displayProductList')->name('display.product.list');
            Route::get('create','PosController@create')->name('create');
            Route::get('show/single/product/details','PosController@singleProductDetails')->name('show.single.product.details');
            
            Route::get('display/single/price/list/by/product/stock/id','PosController@displaySinglePriceListByProductStockId')->name('display.sigle.price.list.by.product.stock.id');
            
            //display product stock and price, when sell create. more than stock, from others stock
            Route::get('display/quantity/wise/single/product/sotck/by/product/id','PosController@displayQuantityWiseSingleProductStockByProductId')->name('display.quantity.wise.sigle.product.stock.by.product.id');
            
            Route::post('store','PosController@store')->name('store');
            //display addted to product list
            Route::get('display/sell/create/added/to/cart/product/list','PosController@displaySellCreateAddedToCartProductList')->name('display.sell.created.added.to.cart.product.list');
            
            //sell final invoice calculation summery [save in session]
            Route::get('/sell/final/invoice/calculation/summery','PosController@invoiceFinalSellCalculationSummery')->name('sell.final.invoice.calculation.summery');

            //remove single item from sell added to cart list
            Route::get('remove/confirm-req/for/single/item/from/sell/added/to/cart/list','PosController@removeConfirmationRequiredForSingleItemFromSellAddedToCartList')->name('remove.confirmation.required.single.item.from.sell.added.to.cart.list');
            Route::get('remove/single/item/from/sell/added/to/cart/list','PosController@removeSingleItemFromSellAddedToCartList')->name('remove.single.item.from.sell.added.to.cart.list');
            
            //remove all item from sell added to cart list
            Route::get('remove/confirm-req/for/all/item/from/sell/added/to/cart/list','PosController@removeConfirmationRequiredForAllItemFromSellAddedToCartList')->name('remove.confirmation.required.all.item.from.sell.added.to.cart.list');
            Route::get('remove/all/item/from/sell/added/to/cart/list','PosController@removeAllItemFromSellAddedToCartList')->name('remove.all.item.from.sell.added.to.cart.list');
            //change quantity [plus or minus]
            Route::get('change/quantity/from/added/to/cart/list','PosController@changeQuantity')->name('change.quantity.from.sell.added.to.cart.list');
            

            // Store data from sell cart
            Route::post('store/data/from/sell/cart','PosController@storeDataFromSellCart')->name('store.data.from.sell.cart');

            //customer shipping address
            Route::post('customer/shipping/address','PosController@customerShippingAddress')->name('customer.shipping.address');
            
        });
        
        //customer shipping address
        Route::group(['as'=> 'admin.customer.', 'prefix'=>'admin/customer/shipping','namespace'=>'Backend\Customer'],function(){
            Route::get('address/details/by','ShippingAddressController@getCustomerShippingAddressDetailsByCustomerId')->name('shipping.address.details.by.customer.id');
        });
        //customer shipping address

        Route::group(['as'=> 'admin.sell.regular.pos.', 'prefix'=>'admin/regular/sell','namespace'=>'Backend\Sell\Prints'],function(){
            //print sell invoice :- pos print
            Route::get('pos/print/from/direct/sell/cart','InvoicePrintController@posPrintFromDirectSellCart')->name('pos.print.from.direct.sell.cart');
            Route::get('normal/print/from/direct/sell/cart','InvoicePrintController@normalPrintFromDirectSellCart')->name('normal.print.from.direct.sell.cart');
        });

        /*
        |-----------------------------------
        | Sell list, print  and others
        |-----------------------------------
        */
        Route::group(['prefix'=>'admin/sell/regular','as'=> 'admin.sell.regular.sell.', 'namespace'=>'Backend\Sell\Details'],function(){
            Route::get('sell/list','SellController@index')->name('index');//->middleware(['permissions:unit|index']);
            Route::get('sell/list/by/ajr','SellController@sellListByAjaxResponse')->name('list.ajaxresponse');//->middleware(['permissions:unit|index']);
            Route::get('sell/single/view','SellController@singleView')->name('single.view');//->middleware(['permissions:unit|index']);
            Route::get('sell/single/invoice/profit/loss','SellController@viewSingleInvoiceProfitLoss')->name('view.single.invoice.profit.loss');
        });
        //quotation
        Route::group(['prefix'=>'admin/sell/regular','as'=> 'admin.sell.regular.quotation.', 'namespace'=>'Backend\Sell\Details'],function(){
            Route::get('quotation/list','QuotationController@index')->name('index');//->middleware(['permissions:unit|index']);
            Route::get('quotation/list/by/ajr','QuotationController@quotationListByAjaxResponse')->name('list.ajaxresponse');//->middleware(['permissions:unit|index']);
            Route::get('quotation/single/view','QuotationController@singleView')->name('single.view');//->middleware(['permissions:unit|index']);
            Route::get('quotation/single/invoice/profit/loss','QuotationController@viewSingleInvoiceProfitLoss')->name('view.single.invoice.profit.loss');
        });

        Route::group(['prefix'=>'admin/sell/regular','as'=> 'admin.sell.regular.','namespace'=>'Backend\Sell\Prints'],function(){
            //print sell invoice :- pos print
            Route::get('pos/print/from/sell/list/by/{invoiceId}','InvoicePrintController@posPrintFromSellList')->name('pos.print.from.sell.list');
            Route::get('normal/print/from/sell/list/by/{invoiceId}','InvoicePrintController@normalPrintFromSellList')->name('normal.print.from.sell.list');
        });
        /*
        |-----------------------------------
        | Sell list, print  and others
        |-----------------------------------
        */
        

        /*
        |-----------------------------------
        | Sell product delivery
        |-----------------------------------
        */
        Route::group(['prefix'=>'admin/sell/product/delivery','as'=> 'admin.sell.product.delivery.', 'namespace'=>'Backend\Sell\Delivery'],function(){
            Route::get('by/sell/invoice','SellProductDeliveryController@index')->name('invoice.wise.list.index');//->middleware(['permissions:unit|index']);
            //Route::get('invoice/wise/list','SellProductDeliveryController@index')->name('list.index');//->middleware(['permissions:unit|index']);
            //Route::get('list/by/ajr','SellProductDeliveryController@sellListByAjaxResponse')->name('sell.list.ajaxresponse');//->middleware(['permissions:unit|index']);
            //Route::get('single/view','SellProductDeliveryController@singleView')->name('sell.single.view');//->middleware(['permissions:unit|index']);
        });
        /*
        |-----------------------------------
        | Sell product delivery
        |-----------------------------------
        */
    /*
    |----------------------------------------
    |   Sell  middleware(['permissions:unit|index','auth_only:auth|yes'])
    |---------------------------------------
    */   


    /*
    |-----------------------------------
    | product stock 
    |-----------------------------------
    */
        Route::group(['prefix'=>'admin/product/stock','as'=> 'admin.product.stock.', 'namespace'=>'Backend\Stock'],function(){
            Route::get('list','StockController@index')->name('index');
            Route::get('list/by/ajr','StockController@stockListByAjaxResponse')->name('list.ajaxresponse');
        });
    /*
    |-----------------------------------
    | product stock 
    |-----------------------------------
    */




});//end auth middleware


