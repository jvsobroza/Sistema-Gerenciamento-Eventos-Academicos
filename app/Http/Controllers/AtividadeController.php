<?php

namespace App\Http\Controllers;
use App\Models\Atividade;
use App\Models\Evento;
use Illuminate\Http\Request;

class AtividadeController extends Controller
{
    public function index()
    {
        $atividades = Atividade::with('evento')->get();
        return view('atividades.index', compact('atividades'));
    }
    public function create()
    {
        $eventos = Evento::all();
        return view('atividades.create', compact('eventos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_evento' => 'required|exists:eventos,id',
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'data' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fim' => 'required',
            'local' => 'required|string',
            'vagas' => 'required|integer',
            'responsaveis' => 'required|string',
            'tipo' => 'required|string',
            'resumo' => 'required|string',
        ]);

        $evento = Evento::findOrFail($data['id_evento']);

        if (
            $data['data'] < $evento->data_inicio ||
            $data['data'] > $evento->data_fim
        ) {
            return back()->withErrors([
                'data' => 'A data da atividade deve estar dentro do período do evento.'
            ])->withInput();
        }

        Atividade::create($data);

        return redirect()->route('atividades.index')
            ->with('success', 'Atividade criada com sucesso!');
    }


    public function edit(Atividade $atividade)
    {
        $eventos = Evento::all();
        return view('atividades.edit', compact('atividade', 'eventos'));
    }

    public function update(Request $request, Atividade $atividade)
    {
        $data = $request->validate([
            'id_evento' => 'required|exists:eventos,id',
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'data' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fim' => 'required',
            'local' => 'required|string',
            'vagas' => 'required|integer',
            'responsaveis' => 'required|string',
            'tipo' => 'required|string',
            'resumo' => 'required|string',
        ]);

        $evento = Evento::findOrFail($data['id_evento']);

        if (
            $data['data'] < $evento->data_inicio ||
            $data['data'] > $evento->data_fim
        ) {
            return back()->withErrors([
                'data' => 'A data da atividade deve estar dentro do período do evento.'
            ])->withInput();
        }

        $atividade->update($data);

        return redirect()->route('atividades.index')
            ->with('success', 'Atividade atualizada com sucesso!');
    }

    public function destroy($id)
    {
        Atividade::destroy($id);
        return redirect()->route('atividades.index');
    }
}
