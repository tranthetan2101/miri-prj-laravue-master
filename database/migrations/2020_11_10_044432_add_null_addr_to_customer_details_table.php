<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullAddrToCustomerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_details', function (Blueprint $table) {
            $table->unsignedInteger('city_id')->nullable()->change();
            $table->unsignedInteger('district_id')->nullable()->change();
            $table->unsignedInteger('ward_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_details', function (Blueprint $table) {
            $table->unsignedInteger('city_id')->nullable(false)->change();
            $table->unsignedInteger('district_id')->nullable(false)->change();
            $table->unsignedInteger('ward_id')->nullable(false)->change();
        });
    }
}
