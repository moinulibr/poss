<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('product_stocks')){
            Schema::create('product_stocks', function (Blueprint $table) {
                
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->integer('stock_id')->nullable();
                $table->integer('product_id')->nullable();

                $table->decimal('available_stock',20,3)->nullable();
                $table->decimal('available_base_stock',20,3)->nullable()->comment('no change, same to product purchase unit');
                $table->decimal('used_stock',20,3)->nullable()->comment('total used stock including stock transfer');
                $table->decimal('used_base_stock',20,3)->nullable()->comment('used base unit stock  including stock transfer');

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
        Schema::dropIfExists('product_stocks');
    }
}
