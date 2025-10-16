<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdCartaToCategoriasTable extends Migration
{
    public function up()
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->string('id_carta')->nullable();
        });
    }

    public function down()
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropColumn('id_carta');
        });
    }
}

