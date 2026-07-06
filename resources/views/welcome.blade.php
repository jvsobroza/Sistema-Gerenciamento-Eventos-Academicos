<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Eventos Acadêmicos</title>

    <link rel="stylesheet" href="{{ asset('css/welcome-pgaluno.css') }}">
</head>

<body>

    <header class="cabecalho-topo">
        <div class="container header-wrapper">

            <h1 class="logo-sistema">
                Se<span>TEIC</span>
            </h1>
            <button class="menu-toggle" id="menuToggle">
                ☰
            </button>

            <nav class="botoes-acao" id="menuNav">
                <a href="{{ route('certificado_verifica') }}" class="link-verificar">
                    Validar Certificado
                </a>
                <a href="{{ route('google.login') }}" class="botao-google-pequeno">
                    Entrar com Google
                </a>
                <a href="{{ route('login') }}" class="botao-admin">
                    Painel Administrativo
                </a>
            </nav>

        </div>
    </header>

    <section class="hero-section">
        <div class="container">
            <h2>Plataforma Integrada de Eventos Acadêmicos</h2>
            <p>
                Inscrições em atividades, controle de presença e emissão de certificados digitais autenticados em um
                único ambiente institucional.
            </p>
            <div class="hero-ctas">
                <a href="#eventos" class="botao-principal">Eventos Disponíveis</a>
            </div>
        </div>
    </section>

    <section class="recursos-sistema">
        <div class="container grid-recursos">
            <div class="cartao-recurso">
                <h3>Programação Geral</h3>
                <p>Acompanhamento de horários, locais e vagas atualizados em tempo real.</p>
            </div>
            <div class="cartao-recurso">
                <h3>Certificação Digital</h3>
                <p>Emissão segura de documentos com validação de autenticidade por código.</p>
            </div>
            <div class="cartao-recurso">
                <h3>Acesso Institucional</h3>
                <p>Integração com Google Auth para login e inscrições simplificadas.</p>
            </div>
        </div>
    </section>

    <main class="container container-eventos" id="eventos">

        <h2 class="secao-titulo">Eventos em Destaque</h2>

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
                        Programação para o dia {{ date('d/m/Y', strtotime($data)) }}
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
                                        <td data-label="Título">
                                            <strong>{{ $atividade->titulo }}</strong>
                                        </td>
                                        <td data-label="Horário">
                                            {{ $atividade->hora_inicio }} - {{ $atividade->hora_fim }}
                                        </td>
                                        <td data-label="Local">
                                            {{ $atividade->local }}
                                        </td>
                                        <td data-label="Vagas">
                                            {{ $atividade->vagas }}
                                        </td>
                                        <td data-label="Ação" class="coluna-acao">
                                            @if($atividade->vagas > 0)

                                                <a href="{{ route('google.login') }}" class="botao-inscrever">
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

            <div class="container-sem-eventos">
                <p class="sem-eventos">
                    Nenhum evento com inscrições abertas no momento.
                </p>
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