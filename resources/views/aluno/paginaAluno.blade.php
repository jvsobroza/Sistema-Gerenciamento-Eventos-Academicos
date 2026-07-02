<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Aluno</title>

    <link rel="stylesheet" href="{{ asset('css/paginaaluno.css') }}">
</head>

<body>

<header class="cabecalho-topo">

    <div class="container">

        <h1 class="titulo-pagina">
            Área do Aluno
        </h1>

        <div class="menu-aluno">

            @if(auth()->user()->tipo == 1)

                <a href="{{ route('adm.dashboard') }}" class="botao-secundario">
                    Voltar ao Painel
                </a>

            @endif

            @if(auth()->user()->tipo == 2)

                <a href="{{ route('aluno.edit', auth()->user()->id) }}"
                   class="botao-secundario">

                    Editar Conta

                </a>

                <form class="form-inline"
                      action="{{ route('logout') }}"
                      method="POST">

                    @csrf

                    <button class="botao-sair" type="submit">
                        Sair
                    </button>

                </form>

            @endif

        </div>

    </div>

</header>

<main class="container container-principal">

@if(session('success'))

    <div class="alerta-sucesso">
        {{ session('success') }}
    </div>

@endif

@forelse($eventos as $evento)

<div class="cartao-evento">

    <h2 class="titulo-evento">
        {{ $evento->nome }}
        <span class="sigla-evento">
            ({{ $evento->sigla }})
        </span>
    </h2>

    @if(auth()->user()->tipo == 2)

        @php
            $certificado = \App\Models\Certificado::where('id_usuario', auth()->id())
                ->where('id_evento', $evento->id)
                ->first();
        @endphp

        @if($certificado)

        <div class="caixa-certificado">

            <p class="texto-certificado">
                ✔ Certificado disponível
            </p>

            <a class="botao-certificado"
               href="{{ asset('storage/'.$certificado->arquivo_salvo) }}"
               target="_blank">

                Ver Certificado

            </a>

        </div>

        @endif

    @endif

    <div class="info-evento">

        <p><strong>Local:</strong> {{ $evento->local }}</p>

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

    <h3 class="titulo-secao">
        Atividades
    </h3>

    @forelse($atividadesPorDia as $data => $atividades)

        <h4 class="data-atividade">

            Dia {{ date('d/m/Y', strtotime($data)) }}

        </h4>

        <div class="tabela-responsiva">

        <table class="tabela-estilizada">

            <thead>

            <tr>

                <th>Título</th>
                <th>Horário</th>
                <th>Local</th>
                <th>Responsável</th>
                <th>Vagas</th>
                <th>Tipo</th>

                @if(auth()->user()->tipo==2)
                    <th class="coluna-acao">Ação</th>
                @endif

            </tr>

            </thead>

            <tbody>

            @foreach($atividades as $atividade)

                @php

                    $inscricao = $atividade->inscricoes
                        ->where('id_usuario',auth()->id())
                        ->first();

                    $atividadeEncerrada = now()->greaterThan(
                        \Carbon\Carbon::parse(
                            $atividade->data.' '.$atividade->hora_fim
                        )
                    );

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

                    <td>
                        <span class="badge-tipo">
                            {{ $atividade->tipo }}
                        </span>
                    </td>

                    @if(auth()->user()->tipo==2)

                    <td class="coluna-acao">

                        @if($inscricao)

                            @if($atividadeEncerrada)

                                <span class="badge-encerrado">
                                    Participação encerrada
                                </span>

                            @else

                                <form action="{{ route('inscricao.destroy',$inscricao->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="botao-desinscrever">

                                        Desinscrever-se

                                    </button>

                                </form>

                            @endif

                        @elseif($atividade->vagas>0)

                            <form action="{{ route('inscricao.store') }}"
                                  method="POST">

                                @csrf

                                <input
                                    type="hidden"
                                    name="id_atividade"
                                    value="{{ $atividade->id }}"
                                >

                                <button class="botao-inscrever">

                                    Inscrever-se

                                </button>

                            </form>

                        @else

                            <span class="badge-lotado">

                                Lotado

                            </span>

                        @endif

                    </td>

                    @endif

                </tr>

            @endforeach

            </tbody>

        </table>

        </div>

    @empty

        <p class="mensagem-vazia">
            Nenhuma atividade cadastrada.
        </p>

    @endforelse

</div>

@empty

<p class="sem-eventos">

    Nenhum evento cadastrado.

</p>

@endforelse

</main>

</body>
</html>