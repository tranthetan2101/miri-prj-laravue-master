<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamePhoneToOrderShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_shipping', function (Blueprint $table) {
            $table->string('name')->nullable()->after('order_id');
            $table->string('phone_number')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_shipping', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('phone_number');
        });
    }
}
