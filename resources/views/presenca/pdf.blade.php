<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Presença</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .assinatura {
            height: 50px;
        }
    </style>
</head>
<body>

    <h2>Lista de Presença</h2>

    <div class="info">
        <p><strong>Atividade:</strong> {{ $atividade->titulo }}</p>
        <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($atividade->data)->format('d/m/Y') }}</p>
        <p><strong>Horário:</strong> {{ $atividade->hora_inicio }} às {{ $atividade->hora_fim }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="45%">Nome do Participante</th>
                <th width="35%">Email</th>
                <th width="20%">Assinatura</th>
            </tr>
        </thead>

        <tbody>
            @forelse($atividade->presencas as $presenca)
                <tr>
                    <td>{{ $presenca->usuario->nome }}</td>
                    <td>{{ $presenca->usuario->email }}</td>
                    <td class="assinatura"></td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nenhum participante presente.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>