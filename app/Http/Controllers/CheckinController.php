<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Models\Presenca;
use App\Models\Inscricao;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function index()
    {
        $atividades = Atividade::whereNotNull('qr_code_hash')->get();
        return view('checkin.index', compact('atividades'));
    }

    public function show(Atividade $atividade)
    {
        $inscritos = $atividade->inscricoes()->with('usuario')->get();
        $presencas = Presenca::where('id_atividade', $atividade->id)->get()->keyBy('id_usuario');
        $hash = $atividade->qr_code_hash;
        return view('checkin.show', compact('atividade', 'inscritos', 'presencas', 'hash'));
    }

    public function store(Request $request)
    {
        Presenca::updateOrCreate(
            ['id_usuario' => $request->usuario_id, 'id_atividade' => $request->atividade_id],
            ['presente' => true]
        );
        return back()->with('success', 'Presença confirmada!');
    }
}