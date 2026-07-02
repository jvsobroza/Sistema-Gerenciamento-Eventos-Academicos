<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AtividadeController;
use \App\Http\Controllers\CertificadoController;
use \App\Http\Controllers\EventoController;
use \App\Http\Controllers\InscricaoController;
use \App\Http\Controllers\PresencaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RelatorioController;
use App\Models\Atividade;
use App\Models\Evento;
use App\Models\Inscricao;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'home'])
    ->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/auth/google', [AuthController::class, 'redirectGoogle'])->name('google.login');

Route::get('/auth/google/callback', [AuthController::class, 'callbackGoogle']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/dashboard', function () {
    $totalAlunos = User::where('tipo', 2)->count();
    $totalEventos = Evento::count();
    $totalInscricoes = Inscricao::count();
    $totalAtividades = Atividade::count();
    $proximosEventos = Evento::where('data_inicio', '>=', now()->toDateString())
        ->orderBy('data_inicio', 'asc')
        ->take(5)
        ->get();
    $ultimosAlunos = User::where('tipo', 2)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    return view('adm.dashboard', compact(
        'totalAlunos',
        'totalEventos',
        'totalInscricoes',
        'totalAtividades',
        'proximosEventos',
        'ultimosAlunos'
    ));
})->middleware('auth')->name('adm.dashboard');

Route::get('/pagina-aluno', [UserController::class, 'paginaAlunos'])->name('aluno.pagina')->middleware('auth');

Route::resource('users', UserController::class)->middleware('auth');

Route::get('/alunos', [UserController::class, 'alunos'])->name('aluno.index')->middleware('auth');

Route::resource('evento', EventoController::class)->middleware('auth');

Route::resource('inscricao', InscricaoController::class)->middleware('auth');

Route::resource('presenca', PresencaController::class)->middleware('auth');

Route::resource('relatorio', RelatorioController::class)->middleware('auth');

Route::resource('atividades', AtividadeController::class)->middleware('auth');

Route::get('/minha-conta', [UserController::class, 'editarConta'])->name('aluno.edit')->middleware('auth');

Route::put('/minha-conta', [UserController::class, 'atualizarConta'])->name('aluno.update')->middleware('auth');

Route::get('/certificados', [CertificadoController::class, 'index'])->name('certificados.index');

Route::get('/certificados/{evento}', [CertificadoController::class, 'evento'])->name('certificados.evento');

Route::get('/certificados/{evento}/{usuario}', [CertificadoController::class, 'pdf'])->name('certificados.pdf');

Route::get('/certificado_verifica', [CertificadoController::class, 'index2'])->name('certificado_verifica');
Route::post('/verifica_certificado', [CertificadoController::class, 'verifica'])->name('certificado.verifica');

Route::get('/presenca/{atividade}/pdf', [PresencaController::class, 'pdf'])
    ->name('presenca.pdf');
