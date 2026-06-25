@extends('sidebar.sidebar')

@section('title', 'Usuários')

@section('content')
    <h1>Lista de Usuários</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p>
            {{ session('error') }}
        </p>
    @endif


    <a href="{{ route('users.create') }}">Cadastrar Administrador</a>

    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 15px; width: 100%;">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->nome }}</td>
                    <td>{{ $user->email }}</td>

                    <td>
                        <a href="{{ route('users.edit', $user->id) }}">Editar</a>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection