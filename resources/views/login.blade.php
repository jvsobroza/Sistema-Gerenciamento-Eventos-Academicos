<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>Área de Login</h3>

    @if($errors->any())
        <p>
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </p>
    @endif

    <form action="/login" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Digite seu email" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" name="password" class="form-control" placeholder="Digite sua senha" required>
        </div>
        <button type="submit">Entrar</button>
        <a href="/">Voltar</a>
    </form>
</body>

</html>