@extends('sidebar.sidebar')

@section('title', 'Usuários')

@section('content')
    <h1>Lista de Usuários</h1>

    <a href="{{ route('users.create') }}">Criar usuário</a>

    <ul>
        @foreach($users as $user)
            <li>
                {{ $user->name }} - {{ $user->email }}

                <a href="{{ route('users.show', $user->id) }}">Ver</a>
                <a href="{{ route('users.edit', $user->id) }}">Editar</a>

                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection