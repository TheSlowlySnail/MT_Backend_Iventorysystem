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
            $table->primary('barcode');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('room')->nullable();
            $table->string('status')->nullable();
            $table->string('annotation')->nullable();
            $table->string('image')->nullable();
            $table->foreign('lend')->references('id')->on('lending')->nullable();
            $table->string('manufactor')->nullable();



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
        Schema::dropIfExists('items');
    }
}
