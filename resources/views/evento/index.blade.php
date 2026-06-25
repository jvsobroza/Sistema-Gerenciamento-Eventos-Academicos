@extends('sidebar.sidebar')

@section('title', 'Eventos')

@section('content')
    <h1>Lista de Eventos</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p>
            {{ session('error') }}
        </p>
    @endif

    <a href="{{ route('evento.create') }}">Criar Evento</a>

    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 15px; width: 100%;">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Sigla</th>
                <th>Local</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($eventos as $evento)
                <tr>
                    <td>{{ $evento->nome }}</td>
                    <td>{{ $evento->sigla }}</td>
                    <td>{{ $evento->local }}</td>
                    <td>{{ $evento->data_inicio }}</td>
                    <td>{{ $evento->data_fim }}</td>

                    <td>
                        <a href="{{ route('evento.edit', $evento->id) }}">Editar</a>

                        <form action="{{ route('evento.destroy', $evento->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" onclick="return confirm('Deseja excluir este evento?')">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection