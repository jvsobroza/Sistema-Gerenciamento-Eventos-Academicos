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
                <a href="{{ route('adm.dashboard') }}">Dashboard Admin</a>
            </li>

            <li>
                <a href="{{ route('users.index') }}">Administradores</a>
            </li>

            <li>
                <a href="{{ route('aluno.pagina') }}">Área do Aluno</a>
            </li>

            <li>
                <a href="{{ route('aluno.index') }}">Alunos</a>
            </li>

            <li>
                <a href="{{ route('evento.index') }}">Eventos</a>
            </li>

             <li>
                <a href="{{ route('atividades.index') }}">Atividades</a>
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