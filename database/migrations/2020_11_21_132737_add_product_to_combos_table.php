<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductToCombosTable extends Migration
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
            Schema::table('combos', function (Blueprint $table) {
				$table->unsignedInteger('product_id')->nullable()->change();
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
        Schema::table('combos', function (Blueprint $table) {
            $table->dropColumn('product_id');
        });
    }
}
