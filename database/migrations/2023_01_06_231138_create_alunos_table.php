<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');

            $table->string('tipo_logradouro')->nullable()->default('Rua');
            $table->string('logradouro', 120)->default('');
            $table->string('numero',20)->default('');
            $table->string('complemento',120)->default('');
            $table->string('cep',8)->default('');
            $table->string('bairro',120)->default('');

            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados')->cascade();
            $table->unsignedBigInteger('cidade_id');
            $table->foreign('cidade_id')->references('id')->on('cidades')->cascade();

            $table->string('telefone',14)->default('');
            $table->string('celular',14)->default('');
            $table->string('email')->default('');

            $table->string('status',3);
            $table->boolean('ativo')->default(1);

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
        Schema::dropIfExists('alunos');
    }
}
