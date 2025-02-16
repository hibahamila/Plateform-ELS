<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('titre'); 
            $table->string('description'); 
            $table->date('date_limite'); 
            $table->date('date_fin'); 
            $table->unsignedBigInteger('cours_id'); 
            $table->foreign('cours_id')->references('id')->on('cours')->onDelete('cascade');
            $table->integer('score_minimum'); 
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
        Schema::dropIfExists('quizzes');
    }
}
