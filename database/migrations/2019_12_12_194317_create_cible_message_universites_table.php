<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCibleMessageUniversitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cible_message_universites', function (Blueprint $table) {
            $table->unsignedInteger('message_universite_id');
            $table->unsignedInteger('filiere_id');
            $table->unsignedInteger('niveau_id');
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
        Schema::dropIfExists('cible_message_universites');
    }
}
