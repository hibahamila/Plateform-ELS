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
            $table->string('title'); 
            $table->longText('description'); 
            $table->date('deadline'); 
            $table->date('end_date'); 
            $table->unsignedBigInteger('cours_id'); 
            $table->foreign('cours_id')->references('id')->on('cours')->onDelete('cascade');
            // $table->integer('minimum_score'); 
            $table->unsignedInteger('minimum_score'); 
            //unsignedInteger pour empêcher les valeurs négatives 

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
