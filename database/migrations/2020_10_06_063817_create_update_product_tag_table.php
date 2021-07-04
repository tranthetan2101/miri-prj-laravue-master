<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateProductTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products',function (Blueprint $table){
            $table->dropColumn('tag');
            $table->boolean('tag_best')->default(0);
            $table->boolean('tag_recommend')->default(0);
            $table->string('tag_sale')->nullable();
            $table->integer('discount_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table){
            $table->integer('tag')->nullable();
            $table->dropColumn('tag_best');
            $table->dropColumn('tag_recommend');
            $table->dropColumn('tag_sale');
            $table->dropColumn('discount_price');
        });
    }
}
