<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_structures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titre');
            $table->text('contenu')->nullable();
            $table->string('taille')->nullable();
            $table->string('format')->nullable();
            $table->string('fichier')->nullable();
            $table->unsignedInteger('structure_id');
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
        Schema::dropIfExists('message_structures');
    }
}
