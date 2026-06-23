<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
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
        $dados['codigo_verificacao'] = $this->codigo();
        $dados['usuario_id'] = $usuario_id;
        $dados['evento_id'] = $evento_id;
        $dados['data_emissao'] = now();
        $dados['carga_horaria'] = $totalHoras;
        $destino = base_path('public/pdfs');
        $pdf->move($destino);
        $dados['arquivo_salvo'] = $pdf;
        Certificado::create($dados);
        return $pdf->download('certificado.pdf');
    }

    private function codigo()
    {
        return strtoupper(substr(bin2hex(random_bytes(4)), 1));
    }

    public function verifica($codigo_verificacao)
    {
        $certificado = Certificado::whereIn('codigo_verificacao', $codigo_verificacao)->exists();
        if ($certificado) {
            return redirect()->route('certificado_verifica.index')
                ->with('success', 'Certificado existente!');
        } else {
            return back()->withErrors([
                'codigo_verificacao' => 'Certificado não encontrado.'
            ])->withInput();
        }
    }

    public function index2()
    {
        return view('certificado_verifica.index');
    }
}
