<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('sell_invoice_details')){
            Schema::create('sell_invoice_details', function (Blueprint $table) {
                $table->id();

                $table->integer('branch_id')->nullable();
                
                $table->integer('sell_invoice_id')->nullable();
                $table->integer('sell_package_id')->nullable();
                $table->integer('product_id')->nullable();
                $table->integer('unit_id')->nullable();
                $table->integer('supplier_id')->nullable();
                $table->integer('product_stock_id')->nullable()->comment('main product stock id');
                $table->string('custom_code',50)->nullable()->comment('product custom_code');
                $table->decimal('quantity',20,2)->nullable();

                $table->decimal('mrp_price',20,2)->nullable();
                $table->decimal('regular_sell_price',20,2)->nullable();
                $table->decimal('sold_price',20,2)->nullable();

                $table->decimal('discount_amount',20,2)->nullable();
                $table->string('discount_type',12)->nullable()->comment('percentage, fixed');
                $table->decimal('total_discount',20,2)->nullable();

                $table->decimal('reference_commission',20,2)->nullable();
                
                $table->decimal('subtotal',20,2)->nullable();
                $table->decimal('purchase_price',20,2)->nullable();
                $table->decimal('total_purchase_price',20,2)->nullable();
                $table->decimal('total_profit',20,2)->nullable();

                $table->text('liability_type')->nullable()->comment('default-null, 1=Warranty,2=Guarantee.json:w_g_type,w_g_type_day,identityNumber');
                $table->text('cart')->nullable()->comment('json:p.name,custom_code,unit_name,wharehouse_id,warehouse_rack_id,sold_price');

                $table->tinyInteger('status')->nullable();
                $table->tinyInteger('delivery_status')->nullable();
                $table->integer('created_by')->nullable();
                
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sell_invoice_details');
    }
}
