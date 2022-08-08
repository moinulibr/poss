<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('sell_packages')){
            Schema::create('sell_packages', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();

                $table->integer('sell_invoice_id')->nullable();
                $table->integer('product_stock_id')->nullable()->comment('product stock wise');
                $table->string('sell_package_no',50)->nullable()->comment('sell package no/number');
                $table->decimal('total_item',20,2)->nullable();
                $table->decimal('total_quantity',20,3)->nullable();
                $table->decimal('total_sold_price',20,2)->nullable();
                $table->decimal('subtotal',20,2)->nullable();
                $table->decimal('total_purchase_price',20,2)->nullable();
                $table->decimal('total_profit',20,2)->nullable();

                $table->tinyInteger('status')->nullable();
                $table->tinyInteger('delivery_status')->nullable();
                

                $table->decimal('stock_process_instanly_qty',20,3)->nullable()->comment('stock processed instantly quantity');
                $table->decimal('stock_process_later_qty',20,3)->nullable()->comment('stock processe latter quantity');
                $table->string('stock_process_later_date')->nullable();
                $table->decimal('total_stock_remaining_process_qty',20,3)->nullable()->comment('stock processe latter quantity');
                $table->decimal('total_stock_processed_qty',20,3)->nullable()->comment('stock processe latter quantity');


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
        Schema::dropIfExists('sell_packages');
    }
}
