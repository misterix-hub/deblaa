<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom')->unique();
            $table->string('sigle')->unique();
            $table->string('logo')->nullable();
            $table->string('telephone')->nullable();
            $table->integer('message_bonus')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('site_web')->nullable();
            $table->tinyInteger('acces');
            $table->tinyInteger('pro');
            $table->softDeletes();
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
        Schema::dropIfExists('structures');
    }
}
