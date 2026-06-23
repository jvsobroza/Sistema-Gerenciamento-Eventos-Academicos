<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

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
            top: 220px;
            left: 90px;
            right: 90px;

            text-align: center;
            color: #333;
        }

        .titulo {
            font-size: 34px;
            font-weight: bold;
            color: #0c6b2f;
            letter-spacing: 2px;
            margin-bottom: 45px;
        }

        .texto {
            font-size: 22px;
            line-height: 1.8;
        }

        .nome {
            display: block;
            margin: 20px 0;

            font-size: 38px;
            font-weight: bold;
            color: #0c6b2f;
        }

        .evento {
            font-weight: bold;
        }

        .carga {
            font-weight: bold;
        }

        .data {
            position: absolute;
            left: 70px;
            bottom: 45px;

            font-size: 14px;
            color: #333;
        }
    </style>
</head>

<body>

    <div class="certificado">

        <img
            class="fundo"
            src="{{ public_path('img/fundo.jpg') }}">

        <div class="conteudo">

            <div class="titulo">
                CERTIFICADO DE PARTICIPAÇÃO
            </div>

            <div class="texto">
                Certificamos que
            </div>

            <div class="nome">
                {{ $usuario->nome }}
            </div>

            <div class="texto">
                participou do evento
                <span class="evento">{{ $evento->nome }}</span>
                com carga horária de
                <span class="carga">{{ $totalHoras }} horas</span>.
            </div>

        </div>

        <div class="data">
            Data de emissão: {{ $dataEmissao }}
        </div>

    </div>

</body>

</html>