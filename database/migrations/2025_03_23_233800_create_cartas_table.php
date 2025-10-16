<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cartas', function (Blueprint $table) {
            $table->id(); // ID único interno para cada carta del usuario
            $table->string('id_carta_api'); // ID de la carta en la API
            $table->string('nombre_carta_api'); // ID de la carta en la API
            $table->unsignedBigInteger('usuario_id'); // FK al usuario que subió la carta
            $table->string('rareza');
            $table->string('estado');
            $table->decimal('precio', 8, 2)->nullable();
            $table->date('fecha_adquisicion')->nullable();
            $table->string('expansion_api_id')->nullable();
            $table->timestamps();

            // Clave foránea
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * mmhv
     */
    public function down(): void
    {
        Schema::dropIfExists('cartas');
    }
};
