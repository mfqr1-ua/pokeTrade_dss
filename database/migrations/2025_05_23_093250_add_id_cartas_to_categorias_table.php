<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdCartasToCategoriasTable extends Migration
{
    public function up()
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->unsignedBigInteger('id_cartas')->nullable();

            $table->foreign('id_cartas')
                ->references('id')
                ->on('cartas')
                ->onDelete('set null'); // o 'cascade' si prefieres
        });
    }

    public function down()
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropForeign(['id_cartas']);
            $table->dropColumn('id_cartas');
        });
    }
}

