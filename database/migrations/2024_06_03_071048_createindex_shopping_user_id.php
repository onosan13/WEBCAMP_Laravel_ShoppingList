<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateindexShoppingUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up():void
    {
        Schema::table('shopping_lists', function (Blueprint $table){
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down():void
    {
        Schema::table('shopping_lists', function (Blueprint $table){
            $table->dropForeign('shopping_lists_user_id_foreign');
            $table->dropIndex('shopping_lists_user_id_index');
        });
    }
}
