<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusPropriedades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('propriedades', function (Blueprint $table) {
            $table->string('status') // Nome da coluna
            ->nullable() // Preenchimento não obrigatório
            ->after('estado'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('propriedades', function (Blueprint $table) {
            //
        });
    }
}
