<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_product_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();

            $table->integer('sell_invoice_id')->nullable();
            $table->integer('sell_product_id')->nullable()->comment('sell product wise');

            $table->integer('product_id')->nullable();
            $table->integer('stock_id')->nullable();
            $table->integer('product_stock_id')->nullable()->comment('sell product stock id');
            $table->decimal('total_quantity',20,3)->nullable();
            $table->decimal('mrp_price',20,2)->nullable();
            $table->decimal('regular_sell_price',20,2)->nullable();
            $table->decimal('sold_price',20,2)->nullable();
            $table->decimal('total_sold_price',20,2)->nullable();
            $table->decimal('purchase_price',20,2)->nullable();
            $table->decimal('total_purchase_price',20,2)->nullable();
            $table->decimal('total_profit',20,2)->nullable();

            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('delivery_status')->nullable();
            

            $table->decimal('stock_process_instantly_qty',20,3)->nullable()->comment('stock processed instantly quantity');
            $table->decimal('stock_process_later_qty',20,3)->nullable()->comment('stock processe latter quantity');
            $table->string('stock_process_later_date')->nullable();
            $table->decimal('total_stock_remaining_process_qty',20,3)->nullable()->comment('stock processe latter quantity');
            $table->decimal('total_stock_processed_qty',20,3)->nullable()->comment('stock processe latter quantity');

            $table->integer('created_by')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sell_product_stocks');
    }
}
