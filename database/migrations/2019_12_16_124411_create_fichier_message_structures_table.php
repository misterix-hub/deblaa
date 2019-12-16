<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichierMessageStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichier_message_structures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('message_structure_id');
            $table->string('fichier');
            $table->string('format');
            $table->string('taille');
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
        Schema::dropIfExists('fichier_message_structures');
    }
}
