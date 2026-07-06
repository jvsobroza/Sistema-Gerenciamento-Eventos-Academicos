@extends('sidebar.sidebar')

@section('title', 'Inscrições')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/inscricaoindex.css') }}">
    <div class="cartao-lista">
        <div class="cabecalho-lista">
            <div>
                <h1 class="titulo-pagina">
                    Inscrições
                </h1>
            </div>
        </div>
        @forelse($eventos as $evento)
            <div class="bloco-evento">
                <div class="cabecalho-evento">
                    <h2 class="titulo-evento">
                        {{ $evento->nome }}
                        <span class="sigla-evento">
                            ({{ $evento->sigla }})
                        </span>
                    </h2>
                    <p class="periodo-evento">
                        {{ date('d/m/Y', strtotime($evento->data_inicio)) }}
                        até
                        {{ date('d/m/Y', strtotime($evento->data_fim)) }}
                    </p>
                </div>
                @forelse($evento->atividades as $atividade)
                    <div class="bloco-atividade">
                        <h3 class="titulo-atividade">
                            <i class="bi bi-calendar-event"></i>
                            {{ $atividade->titulo }}
                        </h3>
                        <div class="tabela-responsiva">
                            <table class="tabela-estilizada">
                                <thead>
                                    <tr>
                                        <th>Aluno</th>
                                        <th>E-mail</th>
                                        <th>Data da Inscrição</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($atividade->inscricoes as $inscricao)
                                        <tr>
                                            <td>
                                                {{ $inscricao->usuario->nome }}
                                            </td>
                                            <td>
                                                {{ $inscricao->usuario->email }}

                                            </td>
                                            <td>
                                                {{ date('d/m/Y', strtotime($inscricao->data_inscricao)) }}

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="texto-centro">
                                                <p>
                                                    Nenhuma inscrição nesta atividade.
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
                            Nenhuma atividade cadastrada neste evento.
                        </p>
                    </div>
                @endforelse
            </div>
        @empty
            <div class="mensagem-vazia">
                <p>
                    Nenhum evento encontrado.
                </p>
            </div>
        @endforelse
    </div>
@endsection