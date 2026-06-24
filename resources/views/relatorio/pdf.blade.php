<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Presença</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #0066cc;
        }

        .header p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }

        .info-section {
            margin-bottom: 20px;
            background: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
        }

        .info-section h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #0066cc;
        }

        .info-row {
            margin: 5px 0;
            font-size: 12px;
        }

        .info-row strong {
            display: inline-block;
            width: 150px;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            background: #e8f4f8;
            padding: 15px;
            border-radius: 5px;
        }

        .stat-box {
            text-align: center;
        }

        .stat-box h4 {
            margin: 0;
            font-size: 12px;
            color: #666;
        }

        .stat-box .value {
            font-size: 24px;
            font-weight: bold;
            color: #0066cc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 11px;
        }

        table thead {
            background-color: #0066cc;
            color: white;
        }

        table th {
            padding: 10px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #0066cc;
        }

        table td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status-presente {
            color: green;
            font-weight: bold;
        }

        .status-ausente {
            color: red;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #666;
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>RELATÓRIO DE PRESENÇA</h1>
        <p>Gerado em {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="info-section">
        <h3>Informações da Atividade</h3>
        <div class="info-row">
            <strong>Atividade:</strong> {{ $atividade->titulo }}
        </div>
        <div class="info-row">
            <strong>Evento:</strong> {{ $atividade->evento->nome }}
        </div>
        <div class="info-row">
            <strong>Data:</strong> {{ \Carbon\Carbon::parse($atividade->data)->format('d/m/Y') }}
        </div>
        <div class="info-row">
            <strong>Horário:</strong> {{ $atividade->hora_inicio }} - {{ $atividade->hora_fim }}
        </div>
        <div class="info-row">
            <strong>Local:</strong> {{ $atividade->local }}
        </div>
        <div class="info-row">
            <strong>Responsáveis:</strong> {{ $atividade->responsaveis }}
        </div>
    </div>

    <div class="stats">
        <div class="stat-box">
            <h4>Total de Inscritos</h4>
            <div class="value">{{ $totalInscritos }}</div>
        </div>
        <div class="stat-box">
            <h4>Total de Presentes</h4>
            <div class="value">{{ $totalPresentes }}</div>
        </div>
        <div class="stat-box">
            <h4>Total de Ausentes</h4>
            <div class="value">{{ $totalInscritos - $totalPresentes }}</div>
        </div>
        <div class="stat-box">
            <h4>Taxa de Presença</h4>
            <div class="value">{{ $taxaPresenca }}%</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 25%;">Nome</th>
                <th style="width: 30%;">Email</th>
                <th style="width: 15%;">Data de Inscrição</th>
                <th style="width: 12%;">Status</th>
                <th style="width: 13%;">Data de Presença</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dados as $index => $dado)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $dado['nome'] }}</td>
                    <td>{{ $dado['email'] }}</td>
                    <td>
                        @if ($dado['data_inscricao'])
                            {{ \Carbon\Carbon::parse($dado['data_inscricao'])->format('d/m/Y H:i') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($dado['presente'])
                            <span class="status-presente">✓ Presente</span>
                        @else
                            <span class="status-ausente">✗ Ausente</span>
                        @endif
                    </td>
                    <td>
                        @if ($dado['data_presenca'])
                            {{ \Carbon\Carbon::parse($dado['data_presenca'])->format('d/m/Y H:i') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Nenhum participante inscrito nesta atividade</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Este relatório foi gerado automaticamente pelo Sistema de Gerenciamento de Eventos Acadêmicos.</p>
    </div>
</body>
</html>
