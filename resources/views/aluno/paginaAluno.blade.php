<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Aluno</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/welcome-pgaluno.css') }}">
</head>

<body>

    <header class="cabecalho-topo">
        <div class="container header-wrapper">

            <h1 class="logo-sistema">Área do <span>Aluno</span></h1>
            <button class="menu-toggle" id="menuToggle">
                ☰
            </button>

            <nav class="botoes-acao" id="menuNav">

                @if(auth()->user()->tipo == 1)
                    <a href="{{ route('adm.dashboard') }}" class="link-verificar">Voltar ao Painel</a>
                @endif

                @if(auth()->user()->tipo == 2)
                    <a href="{{ route('aluno.edit', auth()->user()->id) }}" class="botao-google-pequeno">
                        Editar Conta
                    </a>

                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="botao-admin"
                            style="background-color: var(--vermelho-erro); border-color: var(--vermelho-erro); cursor: pointer;">
                            Sair
                        </button>
                    </form>
                @endif

            </nav>

        </div>
    </header>

    <main class="container container-eventos">
        @if(auth()->user()->tipo == 2)
            <div class="dashboard-header" style="margin-bottom: 30px;">
                <h1
                    style="font-family: 'SN Pro', sans-serif; color: var(--azul-mais-escuro); font-size: 26px; font-weight: 800; margin-bottom: 6px;">
                    Olá, {{ auth()->user()->nome }}!
                </h1>
                <p style="font-size: 14px; color: var(--texto-secundario);">
                    Bem-vindo ao seu painel acadêmico. Acompanhe suas inscrições e certificados abaixo.
                </p>
            </div>

            @if(session('success'))
                <div class="container-sem-eventos"
                    style="border-left: 4px solid var(--verde-principal); margin-bottom: 25px; padding: 15px; text-align: left;">
                    <p style="color: var(--texto-principal); font-weight: 600; font-size: 14px;">{{ session('success') }}</p>
                </div>
            @endif

            <div class="metrics-grid" style="margin-bottom: 40px;">

                <div class="metric-card">
                    <span class="metric-label">Eventos Participados</span>
                    <span class="metric-value">{{ $alunoEventosCount ?? 0 }}</span>
                </div>

                <div class="metric-card">
                    <span class="metric-label">Atividades Inscritas</span>
                    <span class="metric-value">{{ $alunoAtividadesCount ?? 0 }}</span>
                </div>

                <div class="metric-card">
                    <span class="metric-label">Certificados Disponíveis</span>
                    <span class="metric-value">{{ $alunoCertificadosCount ?? 0 }}</span>
                </div>

            </div>

            <h2 class="secao-titulo" style="margin-top: 20px;">Meus Eventos Inscritos</h2>

            @forelse($eventosInscritos as $evento)

                <div class="cartao-evento">

                    <h2 class="titulo-evento">
                        {{ $evento->nome }}
                        <span class="sigla-evento">({{ $evento->sigla }})</span>
                    </h2>

                    @if(auth()->user()->tipo == 2)
                        @php
                            $certificado = \App\Models\Certificado::where('id_usuario', auth()->id())
                                ->where('id_evento', $evento->id)
                                ->first();
                        @endphp

                        @if($certificado)
                            <div class="info-evento"
                                style="border-left-color: var(--verde-principal); display: flex; justify-content: space-between; align-items: center; background-color: rgba(29, 215, 60, 0.05); margin-bottom: 20px;">
                                <span style="color: #117a22; font-weight: 700; font-size: 14px;">✓ Certificado disponível para
                                    download</span>
                                <a href="{{ asset('storage/' . $certificado->arquivo_salvo) }}" target="_blank" class="botao-inscrever">
                                    Ver Certificado
                                </a>
                            </div>
                        @endif
                    @endif

                    <div class="info-evento">
                        <p><strong>Local:</strong> {{ $evento->local }}</p>
                        <p>
                            <strong>Período:</strong>
                            {{ date('d/m/Y', strtotime($evento->data_inicio)) }} até
                            {{ date('d/m/Y', strtotime($evento->data_fim)) }}
                        </p>
                    </div>

                    @php
                        $atividadesPorDia = $evento->atividades->groupBy('data');
                    @endphp

                    @foreach($atividadesPorDia as $data => $atividades)

                        <h3 class="data-atividade">
                            Programação para o dia {{ date('d/m/Y', strtotime($data)) }}
                        </h3>

                        <div class="tabela-responsiva">
                            <table class="tabela-estilizada">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Horário</th>
                                        <th>Local</th>
                                        <th>Tipo</th>
                                        @if(auth()->user()->tipo == 2)
                                            <th class="coluna-acao">Ação</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($atividades as $atividade)
                                        @php
                                            $inscricao = $atividade->inscricoes->where('id_usuario', auth()->id())->first();
                                            $dataHoraFim = \Carbon\Carbon::parse($atividade->data . ' ' . $atividade->hora_fim);
                                            $atividadeEncerrada = now()->greaterThan($dataHoraFim);
                                        @endphp
                                        <tr>
                                            <td><strong>{{ $atividade->titulo }}</strong></td>
                                            <td>{{ $atividade->hora_inicio }} - {{ $atividade->hora_fim }}</td>
                                            <td>{{ $atividade->local }}</td>
                                            <td><span class="item-badge"
                                                    style="background-color: var(--fundo-claro); color: var(--azul-mais-escuro);">{{ $atividade->tipo }}</span>
                                            </td>

                                            @if(auth()->user()->tipo == 2)
                                                <td class="coluna-acao">
                                                    @if($atividadeEncerrada)
                                                        <span
                                                            style="color: var(--texto-secundario); font-size: 13px; font-weight: 500;">Participação
                                                            encerrada</span>
                                                    @else
                                                        <form action="{{ route('inscricao.destroy', $inscricao->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="botao-inscrever"
                                                                style="background-color: var(--vermelho-erro); cursor: pointer; border: none;">
                                                                Desinscrever-se
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach

                </div>

            @empty
                <div class="container-sem-eventos" style="margin-bottom: 40px;">
                    <p class="sem-eventos">Você não possui inscrições ativas em nenhum evento.</p>
                </div>
            @endforelse

        @endif
        <h2 class="secao-titulo" style="margin-top: 40px;">Próximos Eventos Disponíveis</h2>

        @forelse($proximosEventos as $evento)

            <div class="cartao-evento">

                <h2 class="titulo-evento">
                    {{ $evento->nome }}
                    <span class="sigla-evento">({{ $evento->sigla }})</span>
                </h2>

                <div class="info-evento">
                    <p><strong>Local:</strong> {{ $evento->local }}</p>
                    <p>
                        <strong>Período:</strong>
                        {{ date('d/m/Y', strtotime($evento->data_inicio)) }} até
                        {{ date('d/m/Y', strtotime($evento->data_fim)) }}
                    </p>
                    @if($evento->descricao)
                        <p class="descricao-evento">{{ $evento->descricao }}</p>
                    @endif
                </div>

                @php
                    $atividadesPorDia = $evento->atividades->groupBy('data');
                @endphp

                @foreach($atividadesPorDia as $data => $atividades)

                    <h3 class="data-atividade">
                        Programação para o dia {{ date('d/m/Y', strtotime($data)) }}
                    </h3>

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
                                    @if(auth()->user()->tipo == 2)
                                        <th class="coluna-acao">Ação</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($atividades as $atividade)
                                    <tr>
                                        <td data-label="Título"><strong>{{ $atividade->titulo }}</strong></td>
                                        <td data-label="Horário">{{ $atividade->hora_inicio }} - {{ $atividade->hora_fim }}</td>
                                        <td data-label="Local">{{ $atividade->local }}</td>
                                        <td data-label="Responsaveis">{{ $atividade->responsaveis }}</td>
                                        <td data-label="Vagas">{{ $atividade->vagas }}</td>
                                        <td data-label="Tipo"> <span class="item-badge"
                                                style="background-color: var(--fundo-claro); color: var(--azul-mais-escuro);">{{ $atividade->tipo }}</span>
                                        </td>

                                        @if(auth()->user()->tipo == 2)
                                            <td data-label="Ação" class="coluna-acao">
                                                @if($atividade->vagas > 0)
                                                    <form action="{{ route('inscricao.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_atividade" value="{{ $atividade->id }}">
                                                        <button type="submit" class="botao-inscrever"
                                                            style="cursor: pointer; border: none;">
                                                            Inscrever-se
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="badge-lotado">Lotado</span>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach

            </div>

        @empty
            <div class="container-sem-eventos">
                <p class="sem-eventos">Não há novos eventos disponíveis para inscrição no momento.</p>
            </div>
        @endforelse

    </main>

    <footer class="rodape-sistema">
        <div class="container">
            <p>&copy; {{ date('Y') }} Sistema de Eventos Acadêmicos. Todos os direitos reservados - Análise e
                Desenvolvimento de Sistemas.</p>
        </div>
    </footer>
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const menuNav = document.getElementById('menuNav');

        menuToggle.addEventListener('click', () => {
            menuNav.classList.toggle('active');
        });
    </script>
</body>

</html>