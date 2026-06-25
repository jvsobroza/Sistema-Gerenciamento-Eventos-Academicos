@extends('sidebar.sidebar')

@section('title', 'Criar Administrador')

@section('content')
    <h1>Criar Administrador</h1>

    @if($errors->any())
        <p>
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </p>
    @endif


    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div>
            <label>Nome</label>
            <input type="text" name="nome" required>
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>Senha</label>
            <input type="password" name="senha" required>
        </div>

        <div>
            <label>Confirmar Senha</label>
            <input type="password" name="senha_confirmation" required>
        </div>

        <button type="submit">Salvar Administrador</button>
    </form>
    <a href="{{ route('users.index') }}">
        Voltar
    </a>
@endsection