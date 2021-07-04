<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColTitleToSlugTblBlogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('UPDATE `blogs` SET `title` = CONCAT(\'blog-\', `id`);');
        Schema::table('blogs', function (Blueprint $table) {
            $table->renameColumn('title', 'slug');
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
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropIndex('slug');
            $table->renameColumn('slug', 'title');
        });
    }
}
