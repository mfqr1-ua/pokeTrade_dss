<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdCartaApiToPedidosTable extends Migration
{
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->string('id_carta_api')->nullable()->after('comprador_id');
        });
    }

    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn('id_carta_api');
        });
    }
}
