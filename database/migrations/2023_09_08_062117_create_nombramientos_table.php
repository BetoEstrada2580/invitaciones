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
        Schema::create('nombramientos', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->foreignId('evento_id')->constrained()->onDelete('cascade');
            $table->foreignId('invitacion_id')->constrained()->onDelete('cascade');
            $table->string('titulo',50);
            $table->foreignId('imagen_id')->nullable()->constrained()->onDelete('cascade');
            $table->smallInteger('orden');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nombramientos');
    }
};
