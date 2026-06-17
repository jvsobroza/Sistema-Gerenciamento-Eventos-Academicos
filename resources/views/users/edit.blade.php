@extends('sidebar.sidebar')

@section('title', 'Editar Administrador')

@section('content')
    <h1>Editar Administrador</h1>

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Nome</label>
            <input type="text" name="nome" value="{{ $user->nome }}" required>
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div>
            <label>Nova Senha (opcional)</label>
            <input type="password" name="senha">
        </div>

        <div>
            <label>Confirmar Nova Senha</label>
            <input type="password" name="senha_confirmation">
        </div>

        <button type="submit">Atualizar Administrador</button>
    </form>
    
    <a href="{{ route('users.index') }}">Voltar</a>
@endsection