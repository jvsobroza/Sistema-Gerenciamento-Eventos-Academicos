<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use App\Http\Requests\StoreCertificadoRequest;
use App\Http\Requests\UpdateCertificadoRequest;
use App\Models\Atividade;
use App\Models\Presenca;

class CertificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('certificados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCertificadoRequest $request)
    {
        $dados = $request->except('arquivo_salvo');
        $codigo = $this->codigo();
        $dados['codigo'] = $codigo;
        $dados['usuario_id'] = auth()->user()->id;
        $dados['evento_id'] = $request->evento_id;
        $dados['data_emissao'] = now();
        $dados['carga_horaria'] = $this->cargaHorario($request->evento_id, $request->usuario_id);
        if ($request->hasFile('arquivo_salvo')) {
            $pdf = $request->file('arquivo_salvo')->getClientOriginalName();
            $destino = base_path('public/pdfs');
            $request->file('arquivo_salvo')->move($destino, $pdf);
            $dados['arquivo_salvo'] = $pdf;
        }
        Certificado::create($dados);
        return redirect()->route('certificados.index');
    }

    private function cargaHorario($evento_id, $usuario_id)
    {
        $id_atividade = Atividade::where('evento_id', $evento_id)->get();
        $presencas = Presenca::whereIn('atividade_id', $id_atividade)
            ->where('usuario_id', $usuario_id)
            ->get();
        $cargaHoraria = 0;
        foreach ($presencas as $presenca) {
            $atividade = Atividade::find($presenca->atividade_id);
            if ($atividade) {
                $cargaHoraria += $atividade->hora_incio->diffInHours($atividade->hora_fim);
            }
        }
        return $cargaHoraria;
    }

    private function codigo()
    {
        return strtoupper(substr(bin2hex(random_bytes(4)), 1));
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificado $certificado)
    {
        $certificado = Certificado::findOrFail($certificado->id);
        return view('certificados.show', compact('certificado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificado $certificado)
    {
        $certificado = Certificado::findOrFail($certificado->id);
        return view('certificados.edit', compact('certificado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCertificadoRequest $request, Certificado $certificado)
    {
        Certificado::where('id', $certificado->id)->update($request->validated());
        return redirect()->route('certificados.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificado $certificado)
    {
        $certificado = Certificado::findOrFail($certificado->id);
        $certificado->delete();
        return redirect()->route('certificados.index');
    }
}
