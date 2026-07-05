@extends('sidebar.sidebar')

@section('title', 'Certificados')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/indexatividade.css') }}">

    <div class="cartao-lista">

        <div class="cabecalho-lista">
            <h1 class="titulo-pagina">Eventos para Certificados</h1>
        </div>

        <div class="tabela-responsiva">
            <table class="tabela-estilizada">
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Sigla</th>
                        <th>Período</th>
                        <th>Ação</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($eventos as $evento)
                        <tr>
                            <td>{{ $evento->nome }}</td>
                            <td>{{ $evento->sigla }}</td>
                            <td>
                                {{ date('d/m/Y', strtotime($evento->data_inicio)) }}
                                até
                                {{ date('d/m/Y', strtotime($evento->data_fim)) }}
                            </td>
                            <td>
                                <a href="{{ route('certificados.evento', $evento->id) }}" class="botao-editar">
                                    Ver participantes
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection