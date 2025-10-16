<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCestaItemsTable extends Migration
{
    public function up()
    {
        Schema::create('cesta_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cesta_id')->constrained('cestas')->onDelete('cascade');
            $table->foreignId('carta_id')->constrained('cartas')->onDelete('cascade');
            $table->integer('cantidad')->default(1);
            $table->decimal('precio_unitario', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cesta_items');
    }
}
