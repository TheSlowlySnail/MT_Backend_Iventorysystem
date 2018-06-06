<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('barcode')->nullable();
            //$table->unique('barcode');

            $table->string('name');
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->string('room')->nullable();
            $table->string('status')->nullable();
            $table->string('annotation')->nullable();
            $table->string('image')->nullable();
            $table->integer('lend')->unsigned()->nullable();
            $table->string('manufactor')->nullable();



            $table->timestamps();
        });

//        Schema::table('items',function ($table){
//            $table->foreign('lend')->references('id')->on('lending');
//
//        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
