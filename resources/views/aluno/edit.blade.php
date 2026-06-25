<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Conta</title>
</head>

<body>

    <h1>Editar Conta</h1>
    
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('aluno.update') }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nome</label>
        <input type="text" name="nome" value="{{ $user->nome }}">

        <br><br>

        <label>Email</label>
        <input type="email" value="{{ $user->email }}" disabled>

        <br><br>

        <button type="submit">Salvar</button>

        <a href="{{ route('aluno.pagina') }}">Voltar</a>
    </form>

</body>

</html>