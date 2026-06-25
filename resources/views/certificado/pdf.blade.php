<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Certificado</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            font-family: Arial, Helvetica, sans-serif;
        }

        .certificado {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .fundo {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .conteudo {
            position: absolute;
            top: 250px;
            left: 120px;
            right: 120px;
            text-align: center;
            color: #333;
        }

        .texto {
            font-size: 20px;
            line-height: 1.9;
            color: #444;
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .nome {
            margin: 30px 0;
            font-size: 38px;
            font-weight: bold;
            color: #0c6b2f;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .evento {
            font-weight: bold;
            color: #0c6b2f;
        }

        .carga {
            font-weight: bold;
            color: #0c6b2f;
        }

        .rodape {
            position: absolute;
            left: 100px;
            right: 100px;
            bottom: 60px;

            display: flex;
            justify-content: space-between;
            align-items: flex-end;

            color: #333;
        }

        .local-data {
            font-size: 15px;
        }

        .validacao {
            text-align: right;
            font-size: 13px;
            line-height: 1.6;
        }

        .codigo {
            font-weight: bold;
            color: #0c6b2f;
        }
    </style>

</head>

<body>

    <div class="certificado">
        <img class="fundo" src="{{ public_path('img/fundo.jpg') }}">

        <div class="conteudo">

            <div class="texto">
                O Instituto Federal Farroupilha – Campus São Vicente do Sul
                confere o presente certificado a
            </div>

            <div class="nome">
                {{ $usuario->nome }}
            </div>

            <div class="texto">
                pela participação no evento
                <span class="evento">{{ $evento->nome }}</span>,
                realizado no período de
                <strong>{{ date('d/m/Y', strtotime($evento->data_inicio)) }}</strong>
                a
                <strong>{{ date('d/m/Y', strtotime($evento->data_fim)) }}</strong>,
                totalizando
                <span class="carga">{{ $totalHoras }} horas</span>
                de atividades.
            </div>

        </div>

        <div class="rodape">

            <div class="local-data">
                São Vicente do Sul - RS, {{ $dataEmissao }}
            </div>

            <div class="validacao">
                <strong>Código de verificação:</strong>
                <span class="codigo">{{ $codigo }}</span>
                <br>
                <strong>Validação:</strong>
                {{ url('/certificado_verifica') }}
            </div>

        </div>

    </div>

</body>

</html>