<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid', 36)->nullable();
            $table->unsignedSmallInteger('product_status')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('brand_id')->nullable();
            $table->text('description')->nullable()->comment('Thông tin');
            $table->text('description_2')->nullable()->comment('Quy trình');
            $table->text('description_3')->nullable()->comment('Câu hỏi');
            $table->string('sku', 36)->nullable();
            $table->decimal('stock', 10, 9)->default(0);
            $table->boolean('stock_unlimited')->default(false);
            $table->decimal('price', 12, 2)->default(0.00);
            $table->boolean('favorite_flg')->default(false);
            $table->string('capacity')->nullable();
            $table->string('origin')->nullable();
            $table->json('gift_set')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('brand_id')->references('id')->on('brands');
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->string('file_name');
            $table->smallInteger('sort_no');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::create('product_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('tag_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_tags');
    }
}
