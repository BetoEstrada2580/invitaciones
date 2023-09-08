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
        Schema::create('vestimentas', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->foreignId('evento_id')->constrained()->onDelete('cascade');
            $table->smallInteger('Genero');
            $table->smallInteger('tipo_vestimenta_id')->unsigned();
        });

        Schema::table('vestimentas', function($table) {
            $table->foreign('tipo_vestimenta_id')->references('id')
            ->on('tipo_vestimentas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vestimentas');
    }
};
