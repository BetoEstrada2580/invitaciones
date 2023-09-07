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

        Schema::create('eventos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->BigIncrements('id');
            $table->smallInteger('tipo_eventos_id')->unsigned();
            $table->smallInteger('nivel_paquete_id')->unsigned();
            $table->smallInteger('tipo_pase_id')->unsigned();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('festejado');
            $table->string('titulo');
            $table->dateTime('fecha');
            $table->string('mensaje');
            $table->string('titulo_final',100);
            $table->string('mensaje_final',100);
            $table->string('hashtag',100);
            $table->string('video');
            $table->string('cancion');
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamp('created_at');
            $table->bigInteger('uploaded_by')->unsigned();
            $table->foreign('uploaded_by')->references('id')->on('users');
            $table->timestamp('updated_at');
            $table->boolean('deleted')->default(0);
        });

        Schema::table('eventos', function($table) {
            $table->foreign('tipo_eventos_id')->references('id')
            ->on('tipo_eventos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('nivel_paquete_id')->references('id')
            ->on('nivel_paquetes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_pase_id')->references('id')
            ->on('tipo_pases')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eventos', function (Blueprint $table) {
            // $table->dropForeign('eventos_user_id_foreign');
            // $table->dropColumn('user_id');
            // $table->dropForeign('eventos_tipo_eventos_id_foreign');
            // $table->dropColumn('tipo_eventos_id');
            // $table->dropForeign('eventos_nivel_paquete_id_foreign');
            // $table->dropColumn('nivel_paquete_id');
        });
        Schema::dropIfExists('eventos');
    }
};
