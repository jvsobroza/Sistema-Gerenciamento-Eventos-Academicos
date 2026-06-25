<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Presença</title>
</head>
<body>

<h2>Lista de Presença</h2>

<p><strong>Atividade:</strong> {{ $atividade->titulo }}</p>
<p>
    <strong>Data:</strong> {{ \Carbon\Carbon::parse($atividade->data)->format('d/m/Y') }}
</p>
<p>
    <strong>Horário:</strong> {{ $atividade->hora_inicio }} às {{ $atividade->hora_fim }}
</p>

<hr>

<table border="1" width="100%" cellpadding="5">
    <thead>
        <tr>
            <th>Nome do Participante</th>
            <th>Email</th>
        </tr>
    </thead>

    <tbody>
        @forelse($atividade->presencas as $presenca)
            <tr>
                <td>{{ $presenca->usuario->nome }}</td>
                <td>{{ $presenca->usuario->email }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2">Nenhum participante presente.</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>