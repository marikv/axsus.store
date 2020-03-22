<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->bigInteger('cart_id')->nullable()->unsigned();
            $table->integer('type')->default(0)->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('inn')->nullable();
            $table->string('kpp')->nullable();
            $table->string('contactnoe_lico')->nullable();
            $table->string('raschetnyi_schet')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->integer('opf');
            $table->double('sum')->nullable();
            $table->double('discount')->default(0)->nullable();
            $table->string('valuta')->nullable();
            $table->boolean('deleted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
