<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Endereco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco', function (Blueprint $table) {
            $table->unsignedBigInteger('id_endereco')->autoIncrement();
            $table->string('cep',8);
            $table->string('logradouro');
            $table->string('numero',50);
            $table->string('bairro',200);
            $table->string('complemento',200)->default('não tem');
            $table->string('referencia',200)->default('não tem');;
            $table->char('uf' , 2);
            $table->string('cidade',200);
            $table->boolean('condominio')->default(0);
            $table->string('numero_condominio',200)->nullable();
            $table->string('endereco_condominio',200)->nullable();

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
        Schema::dropIfExists('endereco');
    }
}
