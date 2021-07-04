<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('order_key')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('receive_phone_number')->nullable();
            $table->string('addr_number')->nullable();
            $table->string('addr_street')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->unsignedInteger('ward_id')->nullable();
            $table->string('note')->nullable();
            $table->integer('payment_id')->nullable();
            $table->integer('subtotal')->default(0);
            $table->integer('total')->default(0);
            $table->integer('discount')->default(0);
            $table->string('coupon_code')->nullable();
            $table->integer('delivery_fee')->nullable()->default(0);
            $table->integer('tax')->nullable()->default(0);
            $table->timestamp('order_date')->useCurrent();
            $table->timestamp('payment_date')->useCurrent();
            $table->integer('add_point')->default(0);
            $table->integer('use_point')->default(0);
            $table->smallInteger('order_status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('ward_id')->references('id')->on('wards');
            $table->foreign('coupon_code')->references('code')->on('coupons');
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id');
            $table->string('product_name')->nullable();
            $table->decimal('quantity', 10, 0)->default(0);
            $table->decimal('price', 10, 0)->default(0);
            $table->decimal('price2', 10, 0)->default(0);
            $table->string('cate_name')->nullable();
            $table->decimal('tax', 10, 0)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::create('order_receipt', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->string('company_name')->nullable();
            $table->string('company_tax_number')->nullable();
            $table->string('addr')->nullable();
            $table->string('email')->nullable();
            $table->string('receipt_phone_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('order_id')->references('id')->on('orders');
        });

        Schema::create('order_shipping', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->string('addr_number')->nullable();
            $table->string('addr_street')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->unsignedInteger('ward_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_details');
    }
}