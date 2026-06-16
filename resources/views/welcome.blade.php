<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>página inicial</h1>
    <p>Página pública para o usuário</p>
    <a href="{{ route('google.login') }}">Entrar</a>


    <a href="{{ route('login') }}">
        Login Administrador
    </a>
</body>

</html>