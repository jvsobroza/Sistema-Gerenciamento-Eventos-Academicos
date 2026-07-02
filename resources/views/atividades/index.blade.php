@extends('sidebar.sidebar')

@section('title', 'Atividades')

@section('content')
    <div class="cartao-lista">

        <div class="cabecalho-lista">

            <h1 class="titulo-pagina">
                Lista de Atividades
            </h1>

            <a href="{{ route('atividades.create') }}" class="botao-principal">
                Criar Atividade
            </a>

        </div>

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
                        <th>Evento</th>
                        <th>Título</th>
                        <th>Data</th>
                        <th>Hora Início</th>
                        <th>Hora Fim</th>
                        <th>Local</th>
                        <th>Vagas</th>
                        <th>Tipo</th>
                        <th>Ações</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($atividades as $atividade)

                        <tr>

                            <td>
                                {{ $atividade->evento->nome ?? 'Sem evento' }}
                            </td>

                            <td>
                                {{ $atividade->titulo }}
                            </td>

                            <td>
                                {{ date('d/m/Y', strtotime($atividade->data)) }}
                            </td>

                            <td>
                                {{ $atividade->hora_inicio }}
                            </td>

                            <td>
                                {{ $atividade->hora_fim }}
                            </td>

                            <td>
                                {{ $atividade->local }}
                            </td>

                            <td>
                                {{ $atividade->vagas }}
                            </td>

                            <td>

                                <span class="badge-tipo">
                                    {{ $atividade->tipo }}
                                </span>

                            </td>

                            <td>

                                <div class="grupo-botoes">

                                    <a href="{{ route('atividades.edit', $atividade->id) }}" class="botao-editar">

                                        Editar

                                    </a>

                                    <form action="{{ route('atividades.destroy', $atividade->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button class="botao-excluir"
                                            onclick="return confirm('Deseja excluir esta atividade?')">

                                            Excluir

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>
@endsection