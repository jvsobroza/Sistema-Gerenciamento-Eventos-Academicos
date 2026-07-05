@extends('sidebar.sidebar')

@section('title', 'Criar Evento')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/criaratividade.css') }}">

    <div class="cartao-formulario">

        <h1 class="titulo-pagina">Criar Evento</h1>

        @if($errors->any())
            <div class="alerta-erro">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('evento.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="grade-campos">

                <div class="grupo-campo">
                    <label class="rotulo-campo">Nome</label>
                    <input type="text" name="nome" class="campo-input" value="{{ old('nome') }}" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Sigla</label>
                    <input type="text" name="sigla" class="campo-input" value="{{ old('sigla') }}" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Local</label>
                    <input type="text" name="local" class="campo-input" value="{{ old('local') }}" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Data Início</label>
                    <input type="date" name="data_inicio" class="campo-input" value="{{ old('data_inicio') }}" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Data Fim</label>
                    <input type="date" name="data_fim" class="campo-input" value="{{ old('data_fim') }}" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Logo do Evento</label>
                    <input type="file" name="logo" class="campo-input">
                </div>

                <div class="grupo-campo full-width">
                    <label class="rotulo-campo">Descrição</label>
                    <textarea name="descricao" class="campo-input area-texto" required>{{ old('descricao') }}</textarea>
                </div>

            </div>

            <div class="area-botoes">
                <button type="submit" class="botao-principal">Salvar Evento</button>
                <a href="{{ route('evento.index') }}" class="botao-secundario">Voltar</a>
            </div>
        </form>
    </div>
@endsection