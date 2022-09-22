<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PessoaJuridica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa_juridica', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pessoa_juridica')->autoIncrement();
            $table->string('cnpj',14);
            $table->string('razao_social',200);
            $table->string('nome_fantasia',200);
            $table->enum('indicador_inscricao_estadual', ['contribuinte', 'contribuinte_isento', 'nao_contribuinte']);
            $table->string('inscricao_estadual',200)->nullable();

            $table->string('inscricao_municipal',200)->nullable();
            $table->string('situacao_cnpj',200);
            $table->enum('recolhimento', ['recolher', 'retido']);

            $table->unsignedBigInteger('fornecedor_id');

            $table->foreign('fornecedor_id')->references('id_fornecedor')
                                                    ->on('fornecedor')
                                                    ->onDelete('cascade');;

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
        Schema::dropIfExists('pessoa_juridica');
    }
}
