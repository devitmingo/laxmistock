<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('party_id');
            $table->string('invoiceNo')->nullable();
            $table->bigInteger('invoiceSn')->nullable();
            $table->double('total',16,2)->nullable();
            $table->foreign('party_id')->references('id')->on('parties');
            $table->integer('user_id')->default(0);
            $table->integer('session_id')->default(0);
            $table->integer('payment_id')->nullable();
            $table->integer('page')->default(1);
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
        Schema::dropIfExists('sales');
    }
}
