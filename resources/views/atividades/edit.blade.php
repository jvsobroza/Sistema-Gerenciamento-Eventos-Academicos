@extends('sidebar.sidebar')

@section('title', 'Editar Atividade')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/criaratividade.css') }}">

    <div class="cartao-formulario">

        <h1 class="titulo-pagina">
            Editar Atividade
        </h1>

        @if($errors->any())

            <div class="alerta-erro">

                @foreach($errors->all() as $error)

                    <div>{{ $error }}</div>

                @endforeach

            </div>

        @endif

        <form method="POST" action="{{ route('atividades.update', $atividade->id) }}">

            @csrf
            @method('PUT')

            <div class="grade-campos">

                <div class="grupo-campo">
                    <label class="rotulo-campo">Evento</label>

                    <select name="id_evento" class="campo-input" required>

                        @foreach($eventos as $evento)

                            <option value="{{ $evento->id }}" {{ $atividade->id_evento == $evento->id ? 'selected' : '' }}>

                                {{ $evento->nome }}

                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Título</label>

                    <input type="text" name="titulo" class="campo-input" value="{{ $atividade->titulo }}" required>
                </div>

                <div class="grupo-campo full-width">
                    <label class="rotulo-campo">Descrição</label>

                    <textarea name="descricao" class="campo-input area-texto"
                        required>{{ $atividade->descricao }}</textarea>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Data</label>

                    <input type="date" name="data" class="campo-input" value="{{ $atividade->data }}" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Local</label>

                    <input type="text" name="local" class="campo-input" value="{{ $atividade->local }}" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Hora Início</label>

                    <input type="time" name="hora_inicio" class="campo-input" value="{{ $atividade->hora_inicio }}"
                        required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Hora Fim</label>

                    <input type="time" name="hora_fim" class="campo-input" value="{{ $atividade->hora_fim }}" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Vagas</label>

                    <input type="number" name="vagas" class="campo-input" value="{{ $atividade->vagas }}" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Responsáveis</label>

                    <input type="text" name="responsaveis" class="campo-input" value="{{ $atividade->responsaveis }}"
                        required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Tipo</label>

                    <select name="tipo" class="campo-input" required>

                        <option value="PALESTRA" {{ $atividade->tipo == 'PALESTRA' ? 'selected' : '' }}>
                            Palestra
                        </option>

                        <option value="JOGOS" {{ $atividade->tipo == 'JOGOS' ? 'selected' : '' }}>
                            Jogos
                        </option>

                        <option value="OFICINA" {{ $atividade->tipo == 'OFICINA' ? 'selected' : '' }}>
                            Oficina
                        </option>

                        <option value="RODA_DE_REGRESSOS" {{ $atividade->tipo == 'RODA_DE_REGRESSOS' ? 'selected' : '' }}>
                            Roda de Regressos
                        </option>

                        <option value="MINI_CURSO" {{ $atividade->tipo == 'MINI_CURSO' ? 'selected' : '' }}>
                            Mini Curso
                        </option>

                    </select>

                </div>

                <div class="grupo-campo full-width">

                    <label class="rotulo-campo">
                        Resumo
                    </label>

                    <input type="text" name="resumo" class="campo-input" value="{{ $atividade->resumo }}" required>

                </div>

            </div>

            <div class="area-botoes">

                <button type="submit" class="botao-principal">

                    Atualizar Atividade

                </button>

                <a href="{{ route('atividades.index') }}" class="botao-secundario">

                    Voltar

                </a>

            </div>

        </form>

    </div>
@endsection