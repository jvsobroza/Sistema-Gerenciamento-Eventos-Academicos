<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Sora:wght@600;700;800&display=swap"
        rel="stylesheet">
    @stack('head')
</head>

<body>

    @php $user = auth()->user(); @endphp

    <div class="app-shell">
        <div class="sidebar">

            <div class="profile">
                <div class="avatar">
                    {{ strtoupper(substr($user->nome, 0, 1)) }}
                </div>

                <div class="meta">
                    <div class="name">
                        {{ $user->nome }}
                    </div>

                    <div class="role">
                        {{ $user->tipo == 1 ? 'Administrador' : 'Usuário' }}
                    </div>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('adm.dashboard') }}"
                    class="{{ request()->routeIs('adm.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house icon"></i>
                    <span class="label">Dashboard</span>
                </a>

                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="bi bi-people icon"></i>
                    <span class="label">Administradores</span>
                </a>

                <a href="{{ route('aluno.pagina') }}" class="{{ request()->routeIs('aluno.pagina') ? 'active' : '' }}">
                    <i class="bi bi-mortarboard icon"></i>
                    <span class="label">Área do Aluno</span>
                </a>

                <a href="{{ route('aluno.index') }}" class="{{ request()->routeIs('aluno.index') ? 'active' : '' }}">
                    <i class="bi bi-person-badge icon"></i>
                    <span class="label">Alunos</span>
                </a>

                <a href="{{ route('evento.index') }}" class="{{ request()->routeIs('evento.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event icon"></i>
                    <span class="label">Eventos</span>
                </a>

                <a href="{{ route('atividades.index') }}"
                    class="{{ request()->routeIs('atividades.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text icon"></i>
                    <span class="label">Atividades</span>
                </a>

                <a href="{{ route('inscricao.index') }}"
                    class="{{ request()->routeIs('inscricao.*') ? 'active' : '' }}">
                    <i class="bi bi-pencil-square icon"></i>
                    <span class="label">Inscrições</span>
                </a>

                <a href="{{ route('presenca.index') }}" class="{{ request()->routeIs('presenca.*') ? 'active' : '' }}">
                    <i class="bi bi-check2-square icon"></i>
                    <span class="label">Presença</span>
                </a>

                <a href="{{ route('certificados.index') }}"
                    class="{{ request()->routeIs('certificados.*') ? 'active' : '' }}">
                    <i class="bi bi-award icon"></i>
                    <span class="label">Certificados</span>
                </a>

                <div class="divider"></div>

                <div class="cta">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-logout"><i class="bi bi-box-arrow-right"></i> Sair</button>
                    </form>
                </div>
            </nav>
        </div>

        <div class="main-content">
            @yield('content')
        </div>
    </div>

</body>

</html>