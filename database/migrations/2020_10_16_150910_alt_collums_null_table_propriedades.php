<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltCollumsNullTablePropriedades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('propriedades', function (Blueprint $table) {
            $table->integer('numero')->nullable(true)->change();
            $table->string('complemento')->nullable(true)->change();
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
