<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('inn')->nullable()->after('phone');
            $table->string('kpp')->nullable()->after('inn');
            $table->string('contactnoe_lico')->nullable()->after('kpp');
            $table->string('raschetnyi_schet')->nullable()->after('contactnoe_lico');
            $table->string('city')->nullable()->after('raschetnyi_schet');
            $table->text('address')->nullable()->after('city');
            $table->integer('opf')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
