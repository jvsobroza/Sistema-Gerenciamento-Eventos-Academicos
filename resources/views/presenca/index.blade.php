@extends('sidebar.sidebar')

@section('title', 'Lançamento de Presença')

@section('content')

<h1>Lançamento de Presença</h1>

@foreach($eventos as $evento)

    <div style="
        border:1px solid #ccc;
        border-radius:8px;
        padding:15px;
        margin-bottom:20px;
    ">

        <h2>{{ $evento->nome }}</h2>

        <p>
            <strong>Período:</strong>
            {{ \Carbon\Carbon::parse($evento->data_inicio)->format('d/m/Y') }}
            até
            {{ \Carbon\Carbon::parse($evento->data_fim)->format('d/m/Y') }}
        </p>

        <table border="1" cellpadding="8" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Atividade</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Local</th>
                    <th>Tipo</th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>

                @forelse($evento->atividades as $atividade)

                    <tr>
                        <td>{{ $atividade->titulo }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($atividade->data)->format('d/m/Y') }}
                        </td>

                        <td>
                            {{ $atividade->hora_inicio }}
                            às
                            {{ $atividade->hora_fim }}
                        </td>

                        <td>{{ $atividade->local }}</td>

                        <td>{{ $atividade->tipo }}</td>

                        <td>
                            <a href="{{ route('presenca.show', $atividade->id) }}">
                                Lançar Presença
                            </a>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="6">
                            Nenhuma atividade cadastrada.
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>

    </div>

@endforeach

@endsection