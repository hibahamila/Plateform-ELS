<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reponses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id'); 
            
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

            $table->string('contenu'); 
            $table->boolean('est_correcte')->default(false); // Indique si la réponse est correcte

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
        Schema::dropIfExists('reponses');
    }
}
