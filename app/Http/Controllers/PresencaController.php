<?php

namespace App\Http\Controllers;

use App\Models\Presenca;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Atividade;
use Barryvdh\DomPDF\Facade\Pdf;

class PresencaController extends Controller
{
    public function index()
    {
        $eventos = Evento::with('atividades')
            ->orderBy('data_inicio', 'desc')
            ->get();

        return view('presenca.index', compact('eventos'));
    }

    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        Presenca::updateOrCreate(
            [
                'id_usuario' => $request->id_usuario,
                'id_atividade' => $request->id_atividade,
            ],
            [
                'presente' => 1
            ]
        );

        return back();
    }

    public function show($id)
    {
        $atividade = Atividade::with(['inscricoes.usuario'])->findOrFail($id);

        $presencas = Presenca::where('id_atividade', $id)
            ->get()
            ->keyBy('id_usuario');

        return view('presenca.show', compact('atividade', 'presencas'));
    }

    public function edit(Presenca $presenca)
    {
        //
    }

    public function update($id)
    {
        $presenca = Presenca::findOrFail($id);
        $presenca->delete();

        return back();
    }


    public function destroy(Presenca $presenca)
    {
        //
    }


    public function pdf($atividade_id)
    {
        $atividade = Atividade::with('presencas.usuario')
            ->findOrFail($atividade_id);

        $pdf = Pdf::loadView('presenca.pdf', [
            'atividade' => $atividade
        ]);

        return $pdf->download('lista_presenca.pdf');
    }
}
