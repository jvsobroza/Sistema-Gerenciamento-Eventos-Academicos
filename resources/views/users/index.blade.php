@extends('sidebar.sidebar')

@section('title', 'Administradores')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/indexadministradores.css') }}">

    <div class="cartao-lista">
        <div class="cabecalho-lista">
            <div>
                <h1 class="titulo-pagina">
                    <i class="bi bi-people-fill"></i>
                    Administradores
                </h1>
            </div>
            <a href="{{ route('users.create') }}" class="botao-principal">
                Criar Administrador
            </a>
        </div>
        @if(session('success'))
            <div class="alerta-sucesso">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>

        @endif
        @if(session('error'))

            <div class="alerta-erro">
                <i class="bi bi-x-circle-fill"></i>
                {{ session('error') }}
            </div>

        @endif
        <div class="tabela-responsiva">
            <table class="tabela-estilizada">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th class="coluna-acoes">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <strong>{{ $user->nome }}</strong>
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                <div class="grupo-botoes">
                                    <a href="{{ route('users.edit', $user->id) }}" class="botao-editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="botao-excluir"
                                            onclick="return confirm('Tem certeza que deseja excluir este administrador?')">

                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="sem-registros">
                                <i class="bi bi-person-x"></i>
                                <p>Nenhum administrador cadastrado.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection