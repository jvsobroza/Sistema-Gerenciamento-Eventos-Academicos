@extends('sidebar.sidebar')

@section('title', 'Lançamento de Presença')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/inscricaoindex.css') }}">

    <div class="cartao-lista">
        <div class="cabecalho-lista">
            <div>
                <h1 class="titulo-pagina">
                    Lançamento de Presença
                </h1>
            </div>
        </div>

        @forelse($eventos as $evento)
            <div class="bloco-evento">
                <div class="cabecalho-evento">
                    <h2 class="titulo-evento">
                        {{ $evento->nome }}
                    </h2>
                    <p class="periodo-evento">
                        {{ date('d/m/Y', strtotime($evento->data_inicio)) }}
                        até
                        {{ date('d/m/Y', strtotime($evento->data_fim)) }}
                    </p>
                </div>
                <div class="tabela-responsiva">
                    <table class="tabela-estilizada">
                        <thead>
                            <tr>
                                <th>Atividade</th>
                                <th>Data</th>
                                <th>Horário</th>
                                <th>Local</th>
                                <th>Tipo</th>
                                <th class="coluna-acoes">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($evento->atividades as $atividade)
                                <tr>
                                    <td>
                                        <strong>{{ $atividade->titulo }}</strong>
                                    </td>
                                    <td>
                                        {{ date('d/m/Y', strtotime($atividade->data)) }}
                                    </td>
                                    <td>
                                        {{ $atividade->hora_inicio }}
                                        às
                                        {{ $atividade->hora_fim }}

                                    </td>
                                    <td>
                                        {{ $atividade->local }}
                                    </td>
                                    <td>
                                        <span class="badge-tipo">
                                            {{ $atividade->tipo }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="grupo-botoes">
                                            <a href="{{ route('presenca.show', $atividade->id) }}" class="botao-principal-tabela">
                                                Lançar
                                            </a>

                                            <a href="{{ route('presenca.pdf', $atividade->id) }}" class="botao-secundario-tabela">
                                                Imprimir
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="texto-centro">
                                        <p>
                                            Nenhuma atividade cadastrada.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="mensagem-vazia">
                <p>
                    Nenhum evento cadastrado.
                </p>
            </div>
        @endforelse
    </div>
@endsection