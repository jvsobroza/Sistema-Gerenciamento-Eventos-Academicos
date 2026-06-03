<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AtividadeController;
use \App\Http\Controllers\CertificadoController;
use \App\Http\Controllers\EventoController;
use \App\Http\Controllers\InscricaoController;
use \App\Http\Controllers\PresencaController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('alunos', AtividadeController::class);
Route::resource('evento', EventoController::class);
Route::resource('insricao', InscricaoController::class);
Route::resource('presenca', PresencaController::class);
Route::resource('certificado', CertificadoController::class);

