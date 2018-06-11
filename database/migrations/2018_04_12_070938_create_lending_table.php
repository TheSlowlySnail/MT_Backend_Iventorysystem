<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLendingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lending', function (Blueprint $table) {
            $table->increments('id')->unsigned();


            $table->integer('personid')->unsigned();
            $table->string('itemid');
            $table->string('annotation');


            $table->dateTime('startdate');
            $table->dateTime('enddate');
            $table->timestamps();
        });

////        Schema::table('lending',function ($table){
////            $table->foreign('barcode')->references('barcode')->on('items');
////            $table->foreign('personid')->references('personid')->on('persons');
////
////        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lending');
    }
}
