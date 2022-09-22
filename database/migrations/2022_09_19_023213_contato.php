<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contato', function (Blueprint $table) {
            $table->unsignedBigInteger('id_contato')->autoIncrement();
            $table->string('telefone',200)->nullable();
            $table->string('email',200)->nullable();
            $table->enum('tipo_telefone', ['residencial', 'comercial', 'celular'])->nullable();
            $table->enum('tipo_email', ['pessoal', 'comercial', 'outros'])->nullable();

            $table->unsignedBigInteger('contato_principal_id')->nullable();
            $table->unsignedBigInteger('contato_adicional_id')->nullable();

            $table->foreign('contato_principal_id')->references('id_contato_principal')
                                                           ->on('contato_principal')
                                                            ->onDelete('cascade');

            $table->foreign('contato_adicional_id')->references('id_contato_adicional')
                                                           ->on('contato_adicional')
                                                            ->onDelete('cascade');

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

        Schema::table('contato_adicional', function (Blueprint $table) {
            $table->dropForeign(['fornecedor_id']);
        });

        Schema::dropIfExists('contato_adicional');
    }
}
