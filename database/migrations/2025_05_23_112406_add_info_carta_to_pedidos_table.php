<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->string('nombre_carta_api')->nullable();
            $table->string('rareza')->nullable();
            $table->decimal('precio', 8, 2)->nullable();
            $table->string('estado_carta')->nullable();
            $table->string('expansion_api_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn([
                'nombre_carta_api',
                'rareza',
                'precio',
                'estado_carta',
                'expansion_api_id',
            ]);
        });
    }
};
