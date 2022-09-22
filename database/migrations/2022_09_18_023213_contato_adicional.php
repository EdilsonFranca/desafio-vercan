<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContatoAdicional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contato_adicional', function (Blueprint $table) {
            $table->unsignedBigInteger('id_contato_adicional')->autoIncrement();
            $table->string('nome',200);
            $table->string('empresa',200);
            $table->string('cargo',200);

            $table->unsignedBigInteger('fornecedor_id');
            $table->foreign('fornecedor_id')->references('id_fornecedor')
                                                    ->on('fornecedor')
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
