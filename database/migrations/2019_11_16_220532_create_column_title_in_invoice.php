<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnTitleInInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->text('title');
            $table->string('code')->unique;
            $table->double('subtotal')->nullable();
            $table->double('vat')->nullable();
            $table->double('total')->nullable();
            $table->string('state')->nullable();
            $table->timestamp('payment_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('code');
            $table->dropColumn('subtotal');
            $table->dropColumn('vat');
            $table->dropColumn('total');
            $table->dropColumn('state');
            $table->dropColumn('payment_date');
        });
    }
}
