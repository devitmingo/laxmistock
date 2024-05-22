<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuatationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quatation_details', function (Blueprint $table) {
            $table->id();
            $table->integer('quatation_id')->default(0);
            $table->date('date')->nullable();
            $table->string('particular')->nullable();
            $table->double('rate',16,2)->nullable();
            $table->bigInteger('qty')->nullable();
            $table->double('total',16,2)->nullable();
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
        Schema::dropIfExists('quatation_details');
    }
}
