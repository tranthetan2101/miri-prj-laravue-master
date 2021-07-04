<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagesToCoupleProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('couple_products', function (Blueprint $table) {
            $table->string('product1_image')->nullable()->after('product1_id');
            $table->string('product2_image')->nullable()->after('product2_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('couple_products', function (Blueprint $table) {
            $table->dropColumn(['product1_image', 'product2_image']);
        });
    }
}
