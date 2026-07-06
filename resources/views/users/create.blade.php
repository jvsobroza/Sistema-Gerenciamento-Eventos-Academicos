@extends('sidebar.sidebar')

@section('title', 'Criar Administrador')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/formadministrador.css') }}">

    <div class="cartao-formulario">
        <h1 class="titulo-pagina">
            Criar Administrador
        </h1>

        @if($errors->any())
            <div class="alerta-erro">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="grade-campos">
                <div class="grupo-campo full-width">
                    <label class="rotulo-campo">Nome</label>

                    <input type="text" name="nome" value="{{ old('nome') }}" class="campo-input" required>
                </div>

                <div class="grupo-campo full-width">
                    <label class="rotulo-campo">E-mail</label>

                    <input type="email" name="email" value="{{ old('email') }}" class="campo-input" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Senha</label>

                    <input type="password" name="senha" class="campo-input" required>
                </div>

                <div class="grupo-campo">
                    <label class="rotulo-campo">Confirmar Senha</label>

                    <input type="password" name="senha_confirmation" class="campo-input" required>
                </div>
            </div>
            <div class="area-botoes">
                <button class="botao-principal">
                    Salvar Administrador
                </button>
                <a href="{{ route('users.index') }}" class="botao-secundario">
                    Voltar
                </a>
            </div>
        </form>
    </div>
@endsection