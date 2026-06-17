@extends('sidebar.sidebar')

@section('title', 'Editar Atividade')

@section('content')
    <h1>Editar Atividade</h1>

    <a href="{{ route('atividades.index') }}">← Voltar</a>

    <form method="POST" action="{{ route('atividades.update', $atividade->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Evento</label>
            <select name="id_evento" required>
                @foreach($eventos as $evento)
                    <option value="{{ $evento->id }}"
                        {{ $atividade->id_evento == $evento->id ? 'selected' : '' }}>
                        {{ $evento->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Título</label>
            <input type="text" name="titulo" value="{{ $atividade->titulo }}" required>
        </div>

        <div>
            <label>Descrição</label>
            <textarea name="descricao" required>{{ $atividade->descricao }}</textarea>
        </div>

        <div>
            <label>Data</label>
            <input type="date" name="data" value="{{ $atividade->data }}" required>
        </div>

        <div>
            <label>Hora Início</label>
            <input type="time" name="hora_inicio" value="{{ $atividade->hora_inicio }}" required>
        </div>

        <div>
            <label>Hora Fim</label>
            <input type="time" name="hora_fim" value="{{ $atividade->hora_fim }}" required>
        </div>

        <div>
            <label>Local</label>
            <input type="text" name="local" value="{{ $atividade->local }}" required>
        </div>

        <div>
            <label>Vagas</label>
            <input type="number" name="vagas" value="{{ $atividade->vagas }}" required>
        </div>

        <div>
            <label>Responsáveis</label>
            <input type="text" name="responsaveis" value="{{ $atividade->responsaveis }}" required>
        </div>

        <div>
            <label>Tipo</label>
            <input type="text" name="tipo" value="{{ $atividade->tipo }}" required>
        </div>

        <div>
            <label>Resumo</label>
            <input type="text" name="resumo" value="{{ $atividade->resumo }}" required>
        </div>

        <button type="submit">Atualizar Atividade</button>
    </form>
@endsection