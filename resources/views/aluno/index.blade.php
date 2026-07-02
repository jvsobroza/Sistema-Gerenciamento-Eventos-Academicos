@extends('sidebar.sidebar')

@section('title', 'Alunos')

@section('content')
    <div class="cartao-lista">

        <h1 class="titulo-pagina">
            Lista de Alunos
        </h1>

        @if(session('success'))

            <div class="alerta-sucesso">
                {{ session('success') }}
            </div>

        @endif

        @if(session('error'))

            <div class="alerta-erro">
                {{ session('error') }}
            </div>

        @endif

        <div class="tabela-responsiva">

            <table class="tabela-estilizada">

                <thead>

                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th class="coluna-acao">Ações</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $user)

                        <tr>

                            <td>{{ $user->nome }}</td>

                            <td>{{ $user->email }}</td>

                            <td class="coluna-acao">

                                <form class="form-inline" action="{{ route('users.destroy', $user->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="botao-excluir" type="submit"
                                        onclick="return confirm('Tem certeza que deseja excluir?')">

                                        Excluir

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3" style="text-align:center; padding:20px; color:#64748b;">

                                Nenhum aluno encontrado.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
@endsection