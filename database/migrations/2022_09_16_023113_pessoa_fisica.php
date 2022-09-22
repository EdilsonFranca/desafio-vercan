<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PessoaFisica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa_fisica', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pessoa_fisica')->autoIncrement();
            $table->string('nome',200);
            $table->string('cpf',11);
            $table->string('apelido',200)->nullable();
            $table->string('rg',200);

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
        Schema::dropIfExists('pessoa_fisica');
    }
}
