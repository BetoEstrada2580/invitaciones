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
        Schema::create('invitacions', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->foreignId('evento_id')->constrained()->onDelete('cascade');
            $table->foreignId('mesa_id')->constrained()->onDelete('cascade');
            $table->smallInteger('estatus_invitacion_id')->unsigned();
            $table->uuid('codigo');
            $table->string('nombre');
            $table->string('mensaje')->nullable();
            $table->string('mensaje_invitado')->nullable();
            $table->string('email',100)->nullable();
            $table->string('telefono',16)->nullable();
            $table->timestamps();
            $table->smallInteger('pases');
        });

        Schema::table('invitacions', function($table) {
            $table->foreign('estatus_invitacion_id')->references('id')
            ->on('estatus_invitacions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitacions');
    }
};
