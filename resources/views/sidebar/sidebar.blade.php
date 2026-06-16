<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>

<body>

    <div>
        <h2>Sistema</h2>

        <ul>

            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>

            <li>
                <a href="{{ route('adm.dashboard') }}">Dashboard Admin</a>
            </li>

            <li>
                <a href="{{ route('users.index') }}">Usuários</a>
            </li>

            <li>
                <a href="{{ route('aluno.paginaAluno') }}">Área do Aluno</a>
            </li>

            <hr>

            <li>
                <a href="{{ route('alunos.index') }}"></a>
            </li>

            <li>
                <a href="{{ route('evento.index') }}">Eventos</a>
            </li>

            <li>
                <a href="{{ route('insricao.index') }}">Inscrições</a>
            </li>

            <li>
                <a href="{{ route('presenca.index') }}">Presença</a>
            </li>

            <li>
                <a href="{{ route('certificado.index') }}">Certificados</a>
            </li>

            <hr>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Sair</button>
                </form>
            </li>
        </ul>
    </div>

    <div>
        @yield('content')
    </div>

</body>

</html>