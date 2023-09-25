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
        Schema::create('imagens', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->foreignId('evento_id')->constrained()->onDelete('cascade');
            $table->smallInteger('tipo_imagen_id')->unsigned();
            $table->string('url');
        });

        Schema::table('imagens', function($table) {
            $table->foreign('tipo_imagen_id')->references('id')
            ->on('tipo_imagens')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagens');
    }
};
