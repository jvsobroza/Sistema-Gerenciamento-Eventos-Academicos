<?php

namespace App\Http\Controllers;
use App\Models\Evento;
use App\Models\Presenca;
use App\Models\User;

class CertificadoController extends Controller
{
    public function index()
    {
        $eventos = Evento::orderBy('data_inicio', 'desc')->get();

        return view('certificado.index', compact('eventos'));
    }

    public function evento($evento_id)
    {
        $evento = Evento::with(['atividades.presencas.usuario'])
            ->findOrFail($evento_id);

        $usuarios = [];

        foreach ($evento->atividades as $atividade) {
            foreach ($atividade->presencas as $presenca) {
                $usuarios[$presenca->usuario->id] = $presenca->usuario;
            }
        }

        return view('certificado.evento', compact('evento', 'usuarios'));
    }

    public function pdf($evento_id, $usuario_id)
    {
        $evento = Evento::with('atividades')->findOrFail($evento_id);
        $usuario = User::findOrFail($usuario_id);

        $totalHoras = 0;

        foreach ($evento->atividades as $atividade) {

            $presente = Presenca::where('id_atividade', $atividade->id)
                ->where('id_usuario', $usuario_id)
                ->exists();

            if ($presente) {
                $inicio = \Carbon\Carbon::parse($atividade->hora_inicio);
                $fim = \Carbon\Carbon::parse($atividade->hora_fim);

                $totalHoras += $inicio->diffInHours($fim);
            }
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('certificado.pdf', [
            'evento' => $evento,
            'usuario' => $usuario,
            'totalHoras' => $totalHoras,
            'dataEmissao' => now()->format('d/m/Y')
        ]);

        return $pdf->download('certificado.pdf');
    }
}