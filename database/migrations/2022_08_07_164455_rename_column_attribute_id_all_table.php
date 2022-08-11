<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function(Blueprint $table){
            $table->renameColumn('attribute_value_id', 'options');
        });
        Schema::table('order_details', function(Blueprint $table){
            $table->renameColumn('attribute_value_id', 'options');
        });
        Schema::table('wishlists', function(Blueprint $table){
            $table->renameColumn('attribute_value_id', 'options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
