<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('nds')->nullable();//НДС: Не облагается
            $table->string('language_id')->nullable();//Язык (версия): Русский/Английский
            $table->integer('delivery_type_id')->nullable();//Тип поставки: Электронная (e-mail)
            $table->string('delivery_days')->nullable();//Срок поставки лицензионной программы или ключа активации: 2-5 рабочих дней
            $table->text('notes')->nullable();//Примечания
            $table->string('os')->nullable();///Платформа: Windows/ Mac OS
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
            //
        });
    }
}
