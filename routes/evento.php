<?php

use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'eventos',
], function(){

    Route::controller(EventoController::class)->group(function () {
        Route::get('/', 'index')->name('evento.index');
        Route::get('/create', 'create')->name('evento.create');
        Route::get('/{evento}/edit', 'edit')->name('evento.edit');
    });
    
});