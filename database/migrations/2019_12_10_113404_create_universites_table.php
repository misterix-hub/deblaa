<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniversitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('sigle');
            $table->string('logo')->nullable();
            $table->string('telephone');
            $table->integer('message_bonus')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('site_web')->nullable();
            $table->tinyInteger('acces');
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
        Schema::dropIfExists('universites');
    }
}
