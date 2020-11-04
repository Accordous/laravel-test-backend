<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('person', ['PF', 'PJ'])->default('PJ')->comment('PF => Pessoa Fisíca, PJ => Pessoa Jurídica');
            $table->string('document', 18)->comment('CPF Ou CNPJ');
            $table->string('contractor_email')->comment('E-mail do Contratante');
            $table->string('name')->comment('Nome Completo do Contratante');
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
        Schema::dropIfExists('contracts');
    }
}
