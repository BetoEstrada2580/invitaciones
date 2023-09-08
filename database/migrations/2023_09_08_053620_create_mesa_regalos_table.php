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
        Schema::create('mesa_regalos', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->smallInteger('tipo_mesa_regalo_id')->unsigned();
            $table->foreignId('evento_id')->constrained()->onDelete('cascade');
            $table->string('codigo',20)->nullable();
            $table->string('url')->nullable();
            $table->string('banco',50)->nullable();
            $table->string('clabe',18)->nullable();
        });

        Schema::table('mesa_regalos', function($table) {
            $table->foreign('tipo_mesa_regalo_id')->references('id')
            ->on('tipo_mesa_regalos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesa_regalos');
    }
};
