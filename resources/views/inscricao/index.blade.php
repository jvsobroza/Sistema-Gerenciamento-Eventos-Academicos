@extends('sidebar.sidebar')

@section('title', 'Inscrições')

@section('content')

    <h1 class="titulo-pagina">
        Lista de Inscrições
    </h1>

    <div class="cartao-lista">

        @forelse($eventos as $evento)

            <div class="bloco-evento">

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

                @forelse($evento->atividades as $atividade)

                    <div class="bloco-atividade">

                        <h3 class="titulo-atividade">

                            {{ $atividade->titulo }}

                        </h3>

                        <div class="tabela-responsiva">

                            <table class="tabela-estilizada">

                                <thead>

                                    <tr>

                                        <th>Aluno</th>
                                        <th>Email</th>
                                        <th>Data da Inscrição</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($atividade->inscricoes as $inscricao)

                                        <tr>

                                            <td>{{ $inscricao->usuario->nome }}</td>

                                            <td>{{ $inscricao->usuario->email }}</td>

                                            <td>

                                                {{ date('d/m/Y', strtotime($inscricao->data_inscricao)) }}

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="3" class="texto-centro">

                                                Nenhuma inscrição nesta atividade.

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                @empty

                    <p class="mensagem-vazia">

                        Nenhuma atividade cadastrada.

                    </p>

                @endforelse

            </div>

        @empty

            <p class="mensagem-vazia">

                Nenhum evento encontrado.

            </p>

        @endforelse

    </div>

@endsection