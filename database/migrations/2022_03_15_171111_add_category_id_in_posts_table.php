<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdInPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->after('user_id')->default('1');

            $table->foreign('category_id')
                -> references('id')
                ->on('categories');
            });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('category_id');
            $table->dropColumn('category_id');

        });
    }
}
