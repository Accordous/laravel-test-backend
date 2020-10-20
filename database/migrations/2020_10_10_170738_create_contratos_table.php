<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('propriedade_id');
            $table->string('tp_pessoa');
            $table->string('documento');
            $table->string('email_contrat');
            $table->string('nome_contrat');
            $table->timestamps();
            
            $table->foreign('propriedade_id')->references('id')->on('propriedades');
            

        });
    }

 
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
