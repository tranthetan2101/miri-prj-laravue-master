<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAddUniqueSlugProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('UPDATE `products` SET `slug` = CONCAT(\'product-\', `id`);');
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedTinyInteger('active')->default(1)->after('slug');
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('active');
            $table->dropIndex('slug');
        });
    }
}
