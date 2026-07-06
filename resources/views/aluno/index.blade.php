@extends('sidebar.sidebar')

@section('title', 'Alunos')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/indexaluno.css') }}">
    <div class="cartao-lista">
        <div class="cabecalho-pagina">
            <div>
                <h1 class="titulo-pagina">
                    <i class="bi bi-mortarboard-fill"></i>
                    Alunos
                </h1>
            </div>
            <div class="contador-alunos">
                {{ $users->count() }} aluno(s)
            </div>
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
                        <th class="coluna-acao">Ações</th>
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
                            <td class="coluna-acao">
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="form-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="botao-excluir"
                                        onclick="return confirm('Tem certeza que deseja excluir este aluno?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="sem-registros">
                                <i class="bi bi-person-x"></i>
                                <p>Nenhum aluno encontrado.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection