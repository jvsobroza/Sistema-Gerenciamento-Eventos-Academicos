@extends('sidebar.sidebar')

@section('title', 'Editar Administrador')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/formadministrador.css') }}">
    <div class="cartao-formulario">
        <h1 class="titulo-pagina">
            Editar Administrador
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
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="grade-campos">
                <div class="grupo-campo full-width">
                    <label class="rotulo-campo">Nome</label>
                    <input type="text" name="nome" class="campo-input" value="{{ old('nome', $user->nome) }}" required>
                </div>
                <div class="grupo-campo full-width">
                    <label class="rotulo-campo">E-mail</label>
                    <input type="email" name="email" class="campo-input" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="grupo-campo">
                    <label class="rotulo-campo">
                        Nova Senha(opcional)
                    </label>
                    <input type="password" name="senha" class="campo-input">
                </div>
                <div class="grupo-campo">
                    <label class="rotulo-campo">
                        Confirmar Nova Senha
                    </label>
                    <input type="password" name="senha_confirmation" class="campo-input">
                </div>
            </div>
            <div class="area-botoes">
                <button class="botao-principal">
                    Atualizar
                </button>

                <a href="{{ route('users.index') }}" class="botao-secundario">
                    Voltar
                </a>
            </div>
        </form>
    </div>
@endsection