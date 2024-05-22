<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('head_id');
            $table->foreign('head_id')->references('id')->on('heads');
            $table->double('amount',16,2);
            $table->date('date');
            $table->integer('payType');
            $table->text('note')->nullable();
            $table->integer('insertType')->comment('1:expenses,2:income');
            $table->integer('session_id');
            $table->integer('user_id');
            $table->integer('page')->comment('2:expneses,3:income');
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
        Schema::dropIfExists('expenses');
    }
}
