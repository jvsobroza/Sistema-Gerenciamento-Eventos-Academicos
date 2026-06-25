<?php

namespace App\Http\Controllers;
use App\Models\Atividade;
use Illuminate\Support\Facades\Storage;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();
        return view('evento.index', compact('eventos'));
    }

    public function create()
    {
        return view('evento.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required',
            'sigla' => 'required',
            'local' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required',
            'descricao' => 'required',
            'logo' => 'nullable|image'
        ]);

        if ($data['data_fim'] < $data['data_inicio']) {
            return back()->withErrors([
                'data' => 'A data final não pode ser menor que a data inicial.'
            ])->withInput();
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $path;
        }

        Evento::create($data);

        return redirect()->route('evento.index')->with('success', 'Evento cadastrado com sucesso!');
    }

    public function edit(Evento $evento)
    {
        return view('evento.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        $data = $request->validate([
            'nome' => 'required',
            'sigla' => 'required',
            'local' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required',
            'descricao' => 'required',
            'logo' => 'nullable|image'
        ]);

        if ($data['data_fim'] < $data['data_inicio']) {
            return back()->withErrors([
                'data' => 'A data final não pode ser menor que a data inicial.'
            ])->withInput();
        }

        if ($request->hasFile('logo')) {

            if ($evento->logo && \Storage::disk('public')->exists($evento->logo)) {
                \Storage::disk('public')->delete($evento->logo);
            }

            $path = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $path;
        }

        $evento->update($data);

        return redirect()->route('evento.index')->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy(Evento $evento)
    {
        if (Atividade::where('id_evento', $evento->id)->exists()) {
            return redirect()->route('evento.index')
                ->with('error', 'Não é possível excluir este evento pois existem atividades cadastradas.');
        }

        if ($evento->logo && Storage::disk('public')->exists($evento->logo)) {
            Storage::disk('public')->delete($evento->logo);
        }

        $evento->delete();

        return redirect()->route('evento.index')
            ->with('success', 'Evento excluído com sucesso!');
    }
}