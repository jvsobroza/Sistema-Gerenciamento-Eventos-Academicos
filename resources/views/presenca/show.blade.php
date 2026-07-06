@extends('sidebar.sidebar')

@section('title', 'Lançar Presença')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/showpresenca.css') }}">

    <div class="cartao-lista">

        <div class="cabecalho-lista">

            <div>
                <h1 class="titulo-pagina">
                    {{ $atividade->titulo }}
                </h1>
            </div>

            <a href="{{ route('presenca.index') }}" class="botao-secundario">
                Voltar
            </a>

        </div>
        <div class="tabela-responsiva">
            <table class="tabela-estilizada">
                <thead>
                    <tr>
                        <th>Participante</th>
                        <th class="coluna-acoes">
                            Situação
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($atividade->inscricoes as $inscricao)
                        @php
                            $presenca = $presencas[$inscricao->id_usuario] ?? null;
                        @endphp
                        <tr>
                            <td>
                                <strong>{{ $inscricao->usuario->nome }}</strong>
                            </td>
                            <td class="coluna-acoes">
                                @if($presenca && $presenca->presente == 1)
                                    <form action="{{ route('presenca.update', $presenca->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="botao-ausente">
                                            Desmarcar Presença

                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('presenca.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_usuario" value="{{ $inscricao->id_usuario }}">
                                        <input type="hidden" name="id_atividade" value="{{ $atividade->id }}">
                                        <button class="botao-presenca">
                                            Marcar Presença
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="texto-centro">
                                <i class="bi bi-person-x"></i>
                                <p>
                                    Nenhum participante inscrito.
                                </p>

                            </td>

                        </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection