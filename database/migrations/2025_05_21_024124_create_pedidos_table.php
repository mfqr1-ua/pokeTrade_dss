<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('pedidos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cliente_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('cesta_id')->constrained('cestas')->onDelete('cascade');
        $table->string('direccion_envio'); // puedes usar relación si prefieres
        $table->string('nombre_cliente');
        $table->string('metodo_pago'); // Visa, PayPal, etc. No el número real
        $table->timestamp('fecha_pedido')->useCurrent();
        $table->foreignId('comprador_id')->nullable()->constrained('users')->onDelete('set null');
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
        Schema::dropIfExists('pedidos');
    }
};
