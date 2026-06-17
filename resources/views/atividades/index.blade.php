@extends('sidebar.sidebar')

@section('title', 'Atividades')

@section('content')
    <h1>Lista de Atividades</h1>

    <a href="{{ route('atividades.create') }}">Criar Atividade</a>

    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 15px; width: 100%;">
        <thead>
            <tr>
                <th>Evento</th>
                <th>Título</th>
                <th>Data</th>
                <th>Hora Início</th>
                <th>Hora Fim</th>
                <th>Local</th>
                <th>Vagas</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($atividades as $atividade)
                <tr>
                    <td>{{ $atividade->evento->nome ?? 'Sem evento' }}</td>
                    <td>{{ $atividade->titulo }}</td>
                    <td>{{ $atividade->data }}</td>
                    <td>{{ $atividade->hora_inicio }}</td>
                    <td>{{ $atividade->hora_fim }}</td>
                    <td>{{ $atividade->local }}</td>
                    <td>{{ $atividade->vagas }}</td>
                    <td>{{ $atividade->tipo }}</td>

                    <td>
                        <a href="{{ route('atividades.edit', $atividade->id) }}">Editar</a>

                        <form action="{{ route('atividades.destroy', $atividade->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Deseja excluir esta atividade?')">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection