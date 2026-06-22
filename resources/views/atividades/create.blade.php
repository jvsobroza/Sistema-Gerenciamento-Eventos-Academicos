@extends('sidebar.sidebar')

@section('title', 'Criar Atividade')

@section('content')
    <h1>Criar Atividade</h1>

    <form method="POST" action="{{ route('atividades.store') }}">
        @csrf

        <div>
            <label>Evento</label>
            <select name="id_evento" required>
                <option value="">Selecione um evento</option>

                @foreach($eventos as $evento)
                    <option value="{{ $evento->id }}">
                        {{ $evento->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Título</label>
            <input type="text" name="titulo" required>
        </div>

        <div>
            <label>Descrição</label>
            <textarea name="descricao" required></textarea>
        </div>

        <div>
            <label>Data</label>
            <input type="date" name="data" required>
        </div>

        <div>
            <label>Hora Início</label>
            <input type="time" name="hora_inicio" required>
        </div>

        <div>
            <label>Hora Fim</label>
            <input type="time" name="hora_fim" required>
        </div>

        <div>
            <label>Local</label>
            <input type="text" name="local" required>
        </div>

        <div>
            <label>Vagas</label>
            <input type="number" name="vagas" required>
        </div>

        <div>
            <label>Responsáveis</label>
            <input type="text" name="responsaveis" required>
        </div>

        <div>
            <label>Tipo</label>

            <select name="tipo" id="tipo" required>
                <option value="">Selecione o tipo</option>

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

        <div>
            <label>Resumo</label>
            <input type="text" name="resumo" required>
        </div>

        <button type="submit">Salvar Atividade</button>
    </form>
    <a href="{{ route('atividades.index') }}">Voltar</a>
@endsection