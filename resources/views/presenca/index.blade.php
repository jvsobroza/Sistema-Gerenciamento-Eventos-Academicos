@extends('sidebar.sidebar')

@section('title', 'Lançamento de Presença')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <h1 class="fw-bold mb-1">Lançamento de Presença</h1>
        <p class="text-muted mb-0">Selecione uma atividade para registrar ou imprimir presenças.</p>
    </div>

    @forelse($eventos as $evento)

        <div class="card shadow-sm rounded-4 border-0 p-4 mb-4">

            <div class="mb-3">
                <h3 class="fw-bold mb-2">{{ $evento->nome }}</h3>

                <p class="text-muted mb-0">
                    <strong>Período:</strong>
                    {{ \Carbon\Carbon::parse($evento->data_inicio)->format('d/m/Y') }}
                    até
                    {{ \Carbon\Carbon::parse($evento->data_fim)->format('d/m/Y') }}
                </p>
            </div>

            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Atividade</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Local</th>
                        <th>Tipo</th>
                        <th class="text-center">Ações</th>
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
                                {{ $atividade->hora_inicio }} às {{ $atividade->hora_fim }}
                            </td>

                            <td>{{ $atividade->local }}</td>

                            <td>{{ $atividade->tipo }}</td>

                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('presenca.show', $atividade->id) }}"
                                       class="btn btn-sm btn-primary">
                                        Lançar
                                    </a>

                                    <a href="{{ route('presenca.pdf', $atividade->id) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        Imprimir
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Nenhuma atividade cadastrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    @empty
        <div class="card shadow-sm rounded-4 border-0 p-4">
            <p class="text-muted mb-0 text-center">
                Nenhum evento cadastrado.
            </p>
        </div>
    @endforelse

</div>
@endsection