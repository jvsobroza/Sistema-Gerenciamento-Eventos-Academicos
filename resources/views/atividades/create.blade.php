@extends('sidebar.sidebar')

@section('title', 'Criar Atividade')

@section('content')
    <div class="cartao-formulario">

        <h1 class="titulo-pagina">
            Criar Atividade
        </h1>

        @if($errors->any())

            <div class="alerta-erro">

                @foreach($errors->all() as $error)

                    <div>{{ $error }}</div>

                @endforeach

            </div>

        @endif

        <form method="POST" action="{{ route('atividades.store') }}">

            @csrf

            <div class="grade-campos">

                <div class="grupo-campo">

                    <label class="rotulo-campo">
                        Evento
                    </label>

                    <select name="id_evento" class="campo-input" required>

                        <option value="">
                            Selecione um evento
                        </option>

                        @foreach($eventos as $evento)

                            <option value="{{ $evento->id }}">

                                {{ $evento->nome }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="grupo-campo">

                    <label class="rotulo-campo">
                        Título
                    </label>

                    <input type="text" name="titulo" class="campo-input" value="{{ old('titulo') }}" required>

                </div>

                <div class="grupo-campo full-width">

                    <label class="rotulo-campo">
                        Descrição
                    </label>

                    <textarea name="descricao" class="campo-input area-texto" required>{{ old('descricao') }}</textarea>

                </div>

                <div class="grupo-campo">

                    <label class="rotulo-campo">
                        Data
                    </label>

                    <input type="date" name="data" class="campo-input" value="{{ old('data') }}" required>

                </div>

                <div class="grupo-campo">

                    <label class="rotulo-campo">
                        Local
                    </label>

                    <input type="text" name="local" class="campo-input" value="{{ old('local') }}" required>

                </div>

                <div class="grupo-campo">

                    <label class="rotulo-campo">
                        Hora Início
                    </label>

                    <input type="time" name="hora_inicio" class="campo-input" value="{{ old('hora_inicio') }}" required>

                </div>

                <div class="grupo-campo">

                    <label class="rotulo-campo">
                        Hora Fim
                    </label>

                    <input type="time" name="hora_fim" class="campo-input" value="{{ old('hora_fim') }}" required>

                </div>

                <div class="grupo-campo">

                    <label class="rotulo-campo">
                        Vagas
                    </label>

                    <input type="number" name="vagas" class="campo-input" value="{{ old('vagas') }}" required>

                </div>

                <div class="grupo-campo">

                    <label class="rotulo-campo">
                        Responsáveis
                    </label>

                    <input type="text" name="responsaveis" class="campo-input" value="{{ old('responsaveis') }}" required>

                </div>

                <div class="grupo-campo">

                    <label class="rotulo-campo">
                        Tipo
                    </label>

                    <select name="tipo" class="campo-input" required>

                        <option value="">
                            Selecione o tipo
                        </option>

                        <option value="PALESTRA" {{ old('tipo') == 'PALESTRA' ? 'selected' : '' }}>
                            Palestra
                        </option>

                        <option value="JOGOS" {{ old('tipo') == 'JOGOS' ? 'selected' : '' }}>
                            Jogos
                        </option>

                        <option value="OFICINA" {{ old('tipo') == 'OFICINA' ? 'selected' : '' }}>
                            Oficina
                        </option>

                        <option value="RODA_DE_REGRESSOS" {{ old('tipo') == 'RODA_DE_REGRESSOS' ? 'selected' : '' }}>
                            Roda de Regressos
                        </option>

                        <option value="MINI_CURSO" {{ old('tipo') == 'MINI_CURSO' ? 'selected' : '' }}>
                            Mini Curso
                        </option>

                    </select>

                </div>

                <div class="grupo-campo full-width">

                    <label class="rotulo-campo">
                        Resumo
                    </label>

                    <input type="text" name="resumo" class="campo-input" value="{{ old('resumo') }}" required>

                </div>

            </div>

            <div class="area-botoes">

                <button type="submit" class="botao-principal">

                    Salvar Atividade

                </button>

                <a href="{{ route('atividades.index') }}" class="botao-secundario">

                    Voltar

                </a>

            </div>

        </form>

    </div>
@endsection