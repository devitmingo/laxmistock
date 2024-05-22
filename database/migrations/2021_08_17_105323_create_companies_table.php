<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ownerName');
            $table->string('mobile');
            $table->string('mobile2')->nullable();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->string('panNo')->nullable();
            $table->string('gst')->nullable();
            $table->double('openingBal',16,2)->nullable();
            $table->date('date')->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
