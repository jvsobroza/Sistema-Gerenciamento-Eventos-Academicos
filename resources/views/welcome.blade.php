<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Acadêmicos</title>

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>

    <header class="cabecalho-topo">
        <div class="container">

            <h1 class="titulo-pagina">
                Eventos Acadêmicos
            </h1>

            <div class="botoes-acao">

                <a href="{{ route('google.login') }}" class="botao-google-pequeno">
                    Entrar com Google
                </a>

                <a href="{{ route('login') }}" class="botao-admin">
                    Login Administrador
                </a>

            </div>

        </div>
    </header>

    <main class="container container-eventos">

        @forelse($eventos as $evento)

            <div class="cartao-evento">

                <h2 class="titulo-evento">
                    {{ $evento->nome }}
                    <span class="sigla-evento">
                        ({{ $evento->sigla }})
                    </span>
                </h2>

                <div class="info-evento">

                    <p>
                        <strong>Local:</strong>
                        {{ $evento->local }}
                    </p>

                    <p>
                        <strong>Período:</strong>

                        {{ date('d/m/Y', strtotime($evento->data_inicio)) }}
                        até
                        {{ date('d/m/Y', strtotime($evento->data_fim)) }}
                    </p>

                    <p class="descricao-evento">
                        {{ $evento->descricao }}
                    </p>

                </div>

                @php
                    $atividadesPorDia = $evento->atividades->groupBy('data');
                @endphp

                @foreach($atividadesPorDia as $data => $atividades)

                    <h3 class="data-atividade">
                        Dia {{ date('d/m/Y', strtotime($data)) }}
                    </h3>

                    <div class="tabela-responsiva">

                        <table class="tabela-estilizada">

                            <thead>

                                <tr>
                                    <th>Título</th>
                                    <th>Horário</th>
                                    <th>Local</th>
                                    <th>Vagas</th>
                                    <th class="coluna-acao">Ação</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach($atividades as $atividade)

                                    <tr>

                                        <td>{{ $atividade->titulo }}</td>

                                        <td>
                                            {{ $atividade->hora_inicio }}
                                            -
                                            {{ $atividade->hora_fim }}
                                        </td>

                                        <td>{{ $atividade->local }}</td>

                                        <td>{{ $atividade->vagas }}</td>

                                        <td class="coluna-acao">

                                            @if($atividade->vagas > 0)

                                                <a href="{{ route('google.login') }}"
                                                    class="botao-inscrever">

                                                    Inscrever-se

                                                </a>

                                            @else

                                                <span class="badge-lotado">
                                                    Lotado
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endforeach

            </div>

        @empty

            <p class="sem-eventos">
                Nenhum evento disponível.
            </p>

        @endforelse

    </main>

</body>

</html>