<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inscricaoindex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/indexatividade.css') }}">
    <link rel="stylesheet" href="{{ asset('css/indexaluno.css') }}">
    <link rel="stylesheet" href="{{ asset('css/editaratividade.css') }}">
    <link rel="stylesheet" href="{{ asset('css/criaratividade.css') }}">
</head>

<body>

    <div class="layout-admin">

        <aside class="menu-lateral">

            <h2 class="titulo-menu">Sistema</h2>

            <ul class="lista-links">

                <li>
                    <a class="link-menu" href="{{ route('adm.dashboard') }}">
                        Dashboard Admin
                    </a>
                </li>

                <li>
                    <a class="link-menu" href="{{ route('users.index') }}">
                        Administradores
                    </a>
                </li>

                <li>
                    <a class="link-menu" href="{{ route('aluno.pagina') }}">
                        Área do Aluno
                    </a>
                </li>

                <li>
                    <a class="link-menu" href="{{ route('aluno.index') }}">
                        Alunos
                    </a>
                </li>

                <li>
                    <a class="link-menu" href="{{ route('evento.index') }}">
                        Eventos
                    </a>
                </li>

                <li>
                    <a class="link-menu" href="{{ route('atividades.index') }}">
                        Atividades
                    </a>
                </li>

                <li>
                    <a class="link-menu" href="{{ route('inscricao.index') }}">
                        Inscrições
                    </a>
                </li>

                <li>
                    <a class="link-menu" href="{{ route('presenca.index') }}">
                        Presença
                    </a>
                </li>

                <li>
                    <a class="link-menu" href="{{ route('certificados.index') }}">
                        Certificados
                    </a>
                </li>

                <li class="item-sair">

                    <form class="form-sair" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="botao-sair-menu" type="submit">
                            Sair
                        </button>
                    </form>

                </li>

            </ul>

        </aside>

        <main class="area-conteudo">
            @yield('content')
        </main>

    </div>

</body>

</html>