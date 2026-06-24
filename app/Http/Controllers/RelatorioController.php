<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Models\Evento;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index()
    {
        $eventos = Evento::with('atividades')->get();
        return view('relatorio.index', compact('eventos'));
    }

    public function show($id)
    {
        $atividade = Atividade::with(['evento', 'inscricoes.usuario', 'presencas'])->findOrFail($id);
        $totalInscritos = $atividade->inscricoes->count();
        $totalPresentes = $atividade->presencas->where('presente', true)->count();
        
        return view('relatorio.show', compact('atividade', 'totalInscritos', 'totalPresentes'));
    }
}