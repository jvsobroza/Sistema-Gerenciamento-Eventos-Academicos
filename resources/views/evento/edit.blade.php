@extends('sidebar.sidebar')

@section('title', 'Editar Evento')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/criaratividade.css') }}">

    <div class="cartao-formulario">

        <h1 class="titulo-pagina">Editar Evento</h1>

        @if($errors->any())
            <div class="alerta-erro">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('evento.update', $evento->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grade-campos">

                <div class="grupo-campo">
                    <label class="rotulo-campo">Nome</label>
                    <input type="text" name="nome" class="campo-input" value="{{ $evento->nome }}" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Sigla</label>
                    <input type="text" name="sigla" class="campo-input" value="{{ $evento->sigla }}" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Local</label>
                    <input type="text" name="local" class="campo-input" value="{{ $evento->local }}" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Data Início</label>
                    <input type="date" name="data_inicio" class="campo-input" value="{{ $evento->data_inicio }}" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Data Fim</label>
                    <input type="date" name="data_fim" class="campo-input" value="{{ $evento->data_fim }}" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Trocar Logo</label>
                    <input type="file" name="logo" class="campo-input">
                </div>

                <div class="grupo-campo full-width">
                    <label class="rotulo-campo">Descrição</label>
                    <textarea name="descricao" class="campo-input area-texto" required>{{ $evento->descricao }}</textarea>
                </div>

                <div class="grupo-campo full-width">
                    <label class="rotulo-campo">Logo Atual</label>
                    @if($evento->logo)
                        <img src="{{ asset('storage/' . $evento->logo) }}" width="120" style="border-radius: 8px; border: 1px solid var(--cor-borda);">
                    @else
                        <p style="color: var(--texto-secundario);">Sem logo cadastrada.</p>
                    @endif
                </div>

            </div>

            <div class="area-botoes">
                <button type="submit" class="botao-principal">Atualizar Evento</button>
                <a href="{{ route('evento.index') }}" class="botao-secundario">Voltar</a>
            </div>
        </form>
    </div>
@endsection