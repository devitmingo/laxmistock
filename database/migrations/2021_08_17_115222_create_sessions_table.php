<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->date('startDate');
            $table->date('endDate');
            $table->string('name');
            $table->integer('status')->comment('1:active,2:Inactive');
            $table->string('saleInvoicePrefix')->nullable();
            $table->string('QuatationInvoicePrefix')->nullable();
            $table->string('SPPrefix')->comment('supplierPaymentPrefix')->nullable();
            $table->string('CPPrefix')->comment('CustomerPaymentPrefix')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
