<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador de Certificado</title>
</head>

<body>

    <h1>Verificar Certificado</h1>

    @if(session('success'))
        <div style="
            color: green;
            border: 1px solid green;
            padding: 10px;
            margin-bottom: 15px;
        ">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="
            color: red;
            border: 1px solid red;
            padding: 10px;
            margin-bottom: 15px;
        ">
            @foreach($errors->all() as $erro)
                <p>{{ $erro }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('certificado.verifica') }}">
        @csrf

        <div>
            <label>Código do certificado</label>
            <input
                type="text"
                name="codigo_verificacao"
                value="{{ old('codigo_verificacao') }}"
                required
            >
        </div>

        <br>

        <button type="submit">
            Verificar Certificado
        </button>
    </form>

</body>

</html>
