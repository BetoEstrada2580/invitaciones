<?php

use App\Http\Controllers\InvitacionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'invitaciones',
], function(){

    Route::controller(InvitacionController::class)->group(function () {
        Route::get('/', 'index')->name('invitacion.index');
        Route::get('/create', 'eventos')->name('invitacion.create');
        Route::post('/{invitacion}/edit', 'edit')->name('invitacion.edit');
        Route::get('/{eventos}', 'show')->name('invitacion.show');
        Route::get('/eventos', 'eventos')->name('invitacion.eventos');
    });
    
});