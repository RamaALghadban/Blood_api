<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number')->unique();
            $table->string('password');
            $table->string('city');
            $table->string('Address');
            $table->bigInteger('blood_type_id')->unsigned()->nullable();
            $table->foreign('blood_type_id')->references('id')->on('blood_types')->onDelete('cascade');
            $table->integer('weight');
            $table->integer('national_number');
            $table->integer('age');
            $table->string('sex');
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
};
