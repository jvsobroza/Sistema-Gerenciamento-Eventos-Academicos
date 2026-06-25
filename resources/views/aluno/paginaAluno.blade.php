<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Aluno</title>
</head>

<body>

    <h1>Área do Aluno</h1>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <div style="margin-bottom:20px;">

        @if(auth()->user()->tipo == 1)
            <a href="{{ route('evento.index') }}">Voltar</a>
        @endif

        @if(auth()->user()->tipo == 2)
            <a href="{{ route('aluno.edit', auth()->user()->id) }}">
                Editar Conta
            </a>

            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Sair</button>
            </form>
        @endif

    </div>

    @forelse($eventos as $evento)

        <hr>

        <h2>{{ $evento->nome }} ({{ $evento->sigla }})</h2>

        @if(auth()->user()->tipo == 2)

            @php
                $certificado = \App\Models\Certificado::where('id_usuario', auth()->id())
                    ->where('id_evento', $evento->id)
                    ->first();
            @endphp

            @if($certificado)

                <p style="color:green;">
                    Certificado disponível
                </p>

                <a href="{{ asset('storage/' . $certificado->arquivo_salvo) }}" target="_blank">
                    Ver Certificado
                </a>

            @endif

        @endif

        <p>
            <strong>Local:</strong> {{ $evento->local }}
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

        <h3>Atividades</h3>

        @forelse($atividadesPorDia as $data => $atividades)

            <h4>
                Dia {{ date('d/m/Y', strtotime($data)) }}
            </h4>

            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Horário</th>
                        <th>Local</th>
                        <th>Responsável</th>
                        <th>Vagas</th>
                        <th>Tipo</th>

                        @if(auth()->user()->tipo == 2)
                            <th>Ação</th>
                        @endif
                    </tr>
                </thead>

                <tbody>

                    @foreach($atividades as $atividade)

                        @php
                            $inscricao = $atividade->inscricoes
                                ->where('id_usuario', auth()->id())
                                ->first();

                            $dataHoraFim = \Carbon\Carbon::parse(
                                $atividade->data . ' ' . $atividade->hora_fim
                            );

                            $atividadeEncerrada = now()->greaterThan($dataHoraFim);
                        @endphp

                        <tr>

                            <td>{{ $atividade->titulo }}</td>

                            <td>
                                {{ $atividade->hora_inicio }}
                                -
                                {{ $atividade->hora_fim }}
                            </td>

                            <td>{{ $atividade->local }}</td>

                            <td>{{ $atividade->responsaveis }}</td>

                            <td>{{ $atividade->vagas }}</td>

                            <td>{{ $atividade->tipo }}</td>

                            @if(auth()->user()->tipo == 2)

                                <td>

                                    @if($inscricao)

                                        @if($atividadeEncerrada)

                                            <span>
                                                Participação encerrada
                                            </span>

                                        @else

                                            <form action="{{ route('inscricao.destroy', $inscricao->id) }}" method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit">
                                                    Desinscrever-se
                                                </button>

                                            </form>

                                        @endif

                                    @elseif($atividade->vagas > 0)

                                        <form action="{{ route('inscricao.store') }}" method="POST">

                                            @csrf

                                            <input type="hidden" name="id_atividade" value="{{ $atividade->id }}">

                                            <button type="submit">
                                                Inscrever-se
                                            </button>

                                        </form>

                                    @else

                                        <span>Lotado</span>

                                    @endif

                                </td>

                            @endif

                        </tr>

                    @endforeach

                </tbody>

            </table>

            <br>

        @empty

            <p>Nenhuma atividade cadastrada.</p>

        @endforelse

    @empty

        <p>Nenhum evento cadastrado.</p>

    @endforelse

</body>

</html>