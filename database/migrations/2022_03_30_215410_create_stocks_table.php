<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('stocks')){
            Schema::create('stocks', function (Blueprint $table) {
                $table->id();
                $table->integer('stock_type_id')->nullable();
                $table->integer('product_id')->nullable();

                $table->decimal('available_stock',20,3)->nullable();
                $table->decimal('available_base_stock',20,3)->nullable()->comment('available base unit stock');
                $table->decimal('used_stock',20,3)->nullable()->comment('total used stock including stock transfer');
                $table->decimal('used_base_stock',20,3)->nullable()->comment('used base unit stock  including stock transfer');

                $table->decimal('sell_price',20,2)->nullable();
                $table->decimal('whole_sell_price',20,2)->nullable();
                $table->decimal('offer_price',20,2)->nullable();
                $table->decimal('mrp_price',20,2)->nullable();
                $table->decimal('purchase_price',20,2)->nullable();
                
                $table->tinyInteger('stock_lock_applicable')->default(0)->comment('0 = is regular process, 1= activate, never transfer or sell from this stock');
                $table->decimal('stock_lock_quantity',20,3)->nullable();

                $table->string('verified',25)->nullable();
                $table->integer('verified_by')->nullable();
                $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('stocks');
    }
}
