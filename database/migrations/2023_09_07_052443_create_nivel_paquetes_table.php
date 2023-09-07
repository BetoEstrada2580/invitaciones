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
        Schema::create('nivel_paquetes', function (Blueprint $table) {
            $table->smallInteger('id')->unsigned()->primary();
            $table->string('nombre',50);
            $table->double('costo');
            $table->string('descripcion');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nivel_paquetes');
    }
};
