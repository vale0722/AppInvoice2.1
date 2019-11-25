<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnsInClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->text('name');
            $table->text('last_name');
            $table->text('id_type');
            $table->integer('id_card');
            $table->string('email')->unique;
            $table->integer('cellphone')->min('10');
            $table->text('country');
            $table->text('city');
            $table->string('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('last_name');
            $table->dropColumn('id_type');
            $table->dropColumn('id_card');
            $table->dropColumn('email');
            $table->dropColumn('cellphone');
            $table->dropColumn('country');
            $table->dropColumn('city');
            $table->dropColumn('address');
        });
    }
}
