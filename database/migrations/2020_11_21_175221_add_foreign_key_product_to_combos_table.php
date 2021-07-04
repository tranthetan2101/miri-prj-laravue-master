<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyProductToCombosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('combos', 'product_id'))
        {
			Schema::disableForeignKeyConstraints();
            Schema::table('combos', function (Blueprint $table) {				
				$table->foreign('product_id')->references('id')->on('products')->onUpdate(
					'CASCADE'
				)->onDelete('CASCADE');
			});
			Schema::enableForeignKeyConstraints();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('combos', function (Blueprint $table) {
            $table->dropForeign('combos_product_id_foreign');
        });
    }
}
