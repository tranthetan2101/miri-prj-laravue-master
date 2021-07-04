<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoupleProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couple_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product1_id');
            $table->unsignedInteger('product2_id');
            $table->timestamps();

            $table->foreign('product1_id')->references('id')->on('products');
            $table->foreign('product2_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('couple_products');
    }
}
