<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('party_id');
            $table->foreign('party_id')->references('id')->on('parties');
            $table->double('payAmount',16,2);
            $table->date('payDate');
            $table->integer('payType')->nullable();
            $table->text('note')->nullable();
            $table->string('receiptNo');
            $table->bigInteger('receiptSn');
            $table->string('type')->nullable()->comment('1:customer,2:supplier');
            $table->integer('session_id');
            $table->integer('user_id');
            $table->integer('page')->comment('4:customer,5:supplier');
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
        Schema::dropIfExists('payments');
    }
}
