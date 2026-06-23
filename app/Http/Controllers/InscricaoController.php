<?php

namespace App\Http\Controllers;

use App\Models\Inscricao;
use App\Http\Requests\UpdateInscricaoRequest;
use App\Models\Atividade;
use Illuminate\Http\Request;
use App\Models\Evento;

class InscricaoController extends Controller
{

    public function index()
    {
        $eventos = Evento::with([
            'atividades.inscricoes.usuario'
        ])
            ->orderBy('data_inicio', 'desc')
            ->get();

        return view('inscricao.index', compact('eventos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $atividade = Atividade::findOrFail($request->id_atividade);

        if ($atividade->vagas <= 0) {
            return back()->with('error', 'Não há vagas disponíveis.');
        }

        $jaInscrito = Inscricao::where('id_usuario', auth()->id())
            ->where('id_atividade', $atividade->id)
            ->exists();

        if ($jaInscrito) {
            return back()->with('error', 'Você já está inscrito.');
        }

        Inscricao::create([
            'id_usuario' => auth()->id(),
            'id_atividade' => $atividade->id,
        ]);

        $atividade->decrement('vagas');

        return back()->with('success', 'Inscrição realizada com sucesso!');
    }


    public function show(Inscricao $inscricao)
    {
        //
    }

    public function edit(Inscricao $inscricao)
    {
        //
    }

    public function update(UpdateInscricaoRequest $request, Inscricao $inscricao)
    {
        //
    }

    public function destroy($id)
    {
        $inscricao = Inscricao::findOrFail($id);

        if ($inscricao->id_usuario != auth()->id()) {
            abort(403);
        }

        $atividade = Atividade::findOrFail($inscricao->id_atividade);

        $atividade->increment('vagas');

        $inscricao->delete();

        return back()->with('success', 'Inscrição cancelada com sucesso!');
    }
}
