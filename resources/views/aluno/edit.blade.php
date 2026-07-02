<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Conta</title>

    <link rel="stylesheet" href="{{ asset('css/editaraluno.css') }}">
</head>

<body>

    <div class="area-geral">

        <div class="cartao-form">

            <h1 class="titulo-pagina">
                Editar Conta
            </h1>

            @if(session('success'))

                <div class="alerta-sucesso">
                    {{ session('success') }}
                </div>

            @endif

            <form action="{{ route('aluno.update') }}" method="POST">

                @csrf
                @method('PUT')

                <div class="grupo-input">

                    <label class="rotulo-campo">
                        Nome
                    </label>

                    <input
                        type="text"
                        name="nome"
                        value="{{ $user->nome }}"
                        class="campo-input"
                        required>

                </div>

                <div class="grupo-input">

                    <label class="rotulo-campo">
                        Email
                    </label>

                    <input
                        type="email"
                        value="{{ $user->email }}"
                        class="campo-input campo-desabilitado"
                        disabled>

                </div>

                <div class="area-botoes">

                    <button
                        type="submit"
                        class="botao-principal">

                        Salvar Alterações

                    </button>

                    <a
                        href="{{ route('aluno.pagina') }}"
                        class="botao-secundario">

                        Voltar

                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>