@extends('sidebar.sidebar')

@section('title', 'Eventos')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/indexatividade.css') }}">

    <div class="cartao-lista">

        <div class="cabecalho-lista">
            <h1 class="titulo-pagina">Lista de Eventos</h1>
            <a href="{{ route('evento.create') }}" class="botao-principal">Criar Evento</a>
        </div>

        @if(session('success'))
            <div class="alerta-sucesso">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alerta-erro">
                {{ session('error') }}
            </div>
        @endif

        <div class="tabela-responsiva">
            <table class="tabela-estilizada">
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
                            <td>{{ date('d/m/Y', strtotime($evento->data_inicio)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($evento->data_fim)) }}</td>

                            <td>
                                <div class="grupo-botoes">
                                    <a href="{{ route('evento.edit', $evento->id) }}" class="botao-editar">Editar</a>

                                    <form action="{{ route('evento.destroy', $evento->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="botao-excluir"
                                            onclick="return confirm('Deseja excluir este evento?')">
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection