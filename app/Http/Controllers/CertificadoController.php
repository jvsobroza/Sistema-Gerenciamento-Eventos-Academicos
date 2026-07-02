<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use App\Models\Evento;
use App\Models\Presenca;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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

        $codigo = $this->codigo();

        $pdf = Pdf::loadView('certificado.pdf', [
            'evento' => $evento,
            'usuario' => $usuario,
            'totalHoras' => $totalHoras,
            'dataEmissao' => now()->format('d/m/Y'),
            'codigo' => $codigo
        ]);

        $nomeArquivo = "certificado_{$usuario_id}_{$evento_id}.pdf";

        Storage::disk('public')->put(
            "certificados/$nomeArquivo",
            $pdf->output()
        );

        Certificado::updateOrCreate(
            [
                'id_usuario' => $usuario_id,
                'id_evento' => $evento_id
            ],
            [
                'codigo_verificacao' => $codigo,
                'data_emissao' => now(),
                'arquivo_salvo' => "certificados/$nomeArquivo",
                'carga_horaria' => $totalHoras
            ]
        );

        return back()->with('success', 'Certificado gerado com sucesso!');
    }

    private function codigo()
    {
        return strtoupper(substr(bin2hex(random_bytes(4)), 1));
    }

    public function verifica(Request $request)
    {
        $request->validate([
            'codigo_verificacao' => 'required'
        ]);

        $certificado = Certificado::where(
            'codigo_verificacao',
            $request->codigo_verificacao
        )->first();

        if ($certificado) {
            return back()->with(
                'success',
                'Certificado existente!'
            );
        }

        return back()->withErrors([
            'codigo_verificacao' => 'Certificado não encontrado.'
        ]);
    }
    public function index2()
    {
        return view('certificado_verifica.index');
    }
}
