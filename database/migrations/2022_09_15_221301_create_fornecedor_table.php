<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedor', function (Blueprint $table) {
            $table->unsignedBigInteger('id_fornecedor')->autoIncrement();
            $table->text('observacao')->nullable();;
            $table->boolean('ativo');
            $table->enum('tipo', ['pessoa_fisica', 'pessoa_juridica']);

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
        Schema::table('fornecedor', function (Blueprint $table) {
            $table->dropForeign(['endereco_id']);
            $table->dropForeign(['pessoa_fisica_id']);
            $table->dropForeign(['pessoa_juridica_id']);
            $table->dropForeign(['contato_principal_id']);
        });

        Schema::dropIfExists('fornecedor');
    }
}
