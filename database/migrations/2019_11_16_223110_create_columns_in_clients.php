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
            $table->string('email');
            $table->integer('cellphone');
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
            $table->dropColumn('email');
            $table->dropColumn('cellphone');
            $table->dropColumn('country');
            $table->dropColumn('city');
            $table->dropColumn('address');
        });
    }
}
