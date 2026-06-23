@extends('sidebar.sidebar')

@section('title', 'Lançar Presença')

@section('content')

    <h1>{{ $atividade->titulo }}</h1>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">

        <thead>
            <tr>
                <th>Participante</th>
                <th>Ação</th>
            </tr>
        </thead>

        <tbody>

            @foreach($atividade->inscricoes as $inscricao)

                @php
                    $presenca = $presencas[$inscricao->id_usuario] ?? null;
                @endphp

                <tr>

                    <td>
                        {{ $inscricao->usuario->nome }}
                    </td>

                    <td>

                        @if($presenca && $presenca->presente == 1)

                            <form action="{{ route('presenca.update', $presenca->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <button type="submit">
                                    Desmarcar Presença
                                </button>
                            </form>

                        @else

                            <form action="{{ route('presenca.store') }}" method="POST">
                                @csrf

                                <input type="hidden" name="id_usuario" value="{{ $inscricao->id_usuario }}">
                                <input type="hidden" name="id_atividade" value="{{ $atividade->id }}">

                                <button type="submit">
                                    Marcar Presença
                                </button>
                            </form>

                        @endif

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>
     <a href="{{ route('presenca.index') }}">Voltar</a>

@endsection