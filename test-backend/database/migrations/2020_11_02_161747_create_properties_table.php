<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email_owner')->comment('E-mail do Proprietário');
            $table->string('street')->comment('Rua');
            $table->string('number')->comment(('O número de uma Residência pode conter Strings'));
            $table->string('neighborhood')->comment('Bairro');
            $table->string('city')->comment('Cidade');
            $table->string('state')->comment('Estado');
            $table->enum('status', ['C', 'NC'])->default('NC')->comment('C => Contratado, NC => Não Contratado');
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
        Schema::dropIfExists('properties');
    }
}
