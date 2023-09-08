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
        Schema::create('contactos', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->foreignId('evento_id')->constrained()->onDelete('cascade');
            $table->string('titulo',50);
            $table->string('nombre',150);
            $table->string('apellidoPaterno',100)->nullable();
            $table->string('apellidoMaterno',100)->nullable();
            $table->string('email',100)->nullable();
            $table->boolean('enviarCorreo');
            $table->string('telefono',16);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactos');
    }
};
