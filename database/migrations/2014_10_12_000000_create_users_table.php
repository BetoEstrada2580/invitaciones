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
        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->smallInteger('rol_id')->unsigned();
            $table->rememberToken();
            $table->boolean('deleted')->default(0);
            $table->timestamps();
        });

        Schema::table('users', function($table) {
            $table->foreign('rol_id')->references('id')
            ->on('rols')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('users', function (Blueprint $table) {
        //     $table->dropForeign('users_type_foreign');
        //     $table->dropColumn('tipo_usuarios_id');
        // });
        Schema::dropIfExists('users');
    }
};
