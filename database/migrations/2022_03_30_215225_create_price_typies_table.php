<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceTypiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('price_typies')){
            Schema::create('price_typies', function (Blueprint $table) {
                $table->id();
                $table->string('name',50)->nullable();
                $table->text('description')->nullable();
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
        Schema::dropIfExists('price_typies');
    }
}
