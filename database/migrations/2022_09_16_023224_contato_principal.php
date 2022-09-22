<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContatoPrincipal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contato_principal', function (Blueprint $table) {
            $table->unsignedBigInteger('id_contato_principal')->autoIncrement();
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
        Schema::dropIfExists('contato_principal');
    }
}
