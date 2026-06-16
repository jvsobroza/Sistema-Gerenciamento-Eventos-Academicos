<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Models\Evento;


use App\Http\Requests\StoreAtividadeRequest;
use App\Http\Requests\UpdateAtividadeRequest;

class AtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atividade = Atividade::all();
        return view('atividades.index', compact('atividades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view ("create.index");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAtividadeRequest $request)
    {
        Atividade::create($request->all());
        return redirect()->route('atividades.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Atividade $atividades)
    {
        return view('atividades.show', compact('atividade'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,$id_evento)
    {
        $evento = Evento::findOrFail($id_evento)
        $atividade = Atividade::findOrFail($id);
        return view('atividades.edit', compact('atividade','evento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAtividadeRequest $request, $id)
    {
        $atividade = Atividade::findOrFail($id);
        $atividade->update($request->all());
        return redirect()->route('atividades.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Atividade::destroy($id);
        return redirect()->route('atividades.index');
    }
}
