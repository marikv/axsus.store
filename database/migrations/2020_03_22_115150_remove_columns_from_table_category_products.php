<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromTableCategoryProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('category_products','count')) {
            Schema::table('category_products', function (Blueprint $table) {
                $table->dropColumn('count');
            });
        }
        if(Schema::hasColumn('category_products','price')) {
            Schema::table('category_products', function (Blueprint $table) {
                $table->dropColumn('price');
            });
        }
        if(Schema::hasColumn('category_products','deleted')) {
            Schema::table('category_products', function (Blueprint $table) {
                $table->dropColumn('deleted');
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
        Schema::table('category_products', function (Blueprint $table) {
            //
        });
    }
}
