<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Eventos Acadêmicos</title>
</head>

<body>

    <h1>Eventos Acadêmicos</h1>

    <a href="{{ route('google.login') }}">
        Entrar com Google
    </a>

    <a href="{{ route('login') }}">
        Login Administrador
    </a>

    <hr>

    @forelse($eventos as $evento)

        <h2>{{ $evento->nome }} ({{ $evento->sigla }})</h2>

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

        <p>{{ $evento->descricao }}</p>

        @php
            $atividadesPorDia = $evento->atividades->groupBy('data');
        @endphp

        @foreach($atividadesPorDia as $data => $atividades)

            <h4>
                Dia {{ date('d/m/Y', strtotime($data)) }}
            </h4>

            <table border="1" cellpadding="5">
                <tr>
                    <th>Título</th>
                    <th>Horário</th>
                    <th>Local</th>
                    <th>Vagas</th>
                    <th>Ação</th>
                </tr>

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

                        <td>

                            @if($atividade->vagas > 0)

                                <a href="{{ route('google.login') }}">
                                    Inscrever-se
                                </a>

                            @else

                                Lotado

                            @endif

                        </td>

                    </tr>

                @endforeach

            </table>

        @endforeach

        <hr>

    @empty

        <p>Nenhum evento disponível.</p>

    @endforelse

</body>

</html>