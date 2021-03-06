<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');


            $table->string('personid')->unique();
            $table->string('email')->unique();

            $table->string('firstname');
            $table->string('lastname');

            //$table->text('annotation');


            $table->string('password');
            $table->string('role');

//            $table->integer('personid');
//            $table->unique('personid');
//
//            $table->string('firstname');
//            $table->string('lastname');
//
            $table->string('annotation')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
