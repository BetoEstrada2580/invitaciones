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
        Schema::create('ubicacions', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->foreignId('evento_id')->constrained()->onDelete('cascade');
            $table->smallInteger('tipo_ubicacion_id')->unsigned();
            $table->string('nombre',200);
            $table->dateTime('fecha');
            $table->string('direccion');
            $table->string('url');
        });

        Schema::table('ubicacions', function($table) {
            $table->foreign('tipo_ubicacion_id')->references('id')
            ->on('tipo_ubicacions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicacions');
    }
};
