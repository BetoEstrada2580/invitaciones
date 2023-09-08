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
        Schema::create('mesas', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->foreignId('evento_id')->constrained()->onDelete('cascade');
            $table->string('nombre');
            $table->smallInteger('forma_mesa_id')->unsigned();
            $table->smallInteger('seccion_mesa_id')->unsigned();
            $table->smallInteger('capacidad');
            $table->boolean('llena')->default(0);
        });

        Schema::table('mesas', function($table) {
            $table->foreign('forma_mesa_id')->references('id')
            ->on('forma_mesas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('seccion_mesa_id')->references('id')
            ->on('seccion_mesas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesas');
    }
};
