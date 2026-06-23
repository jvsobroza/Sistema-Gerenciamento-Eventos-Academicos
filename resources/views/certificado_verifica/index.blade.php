<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verificador Certificado</title>
</head>

<body>
    <h1>Verificar certificado:</h1>

    <form method="POST" action="{{ route('certificado.verifica') }}">
        @csrf

        <div>
            <label>Código do certificado</label>
            <input type="text" name="codigo_verificacao" required>
        </div>

        <button type="submit">Verificar Certificado</button>
    </form>
</body>

</html>