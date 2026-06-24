@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-chart-bar"></i> Relatórios de Presença
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="mb-3">Relatório por Atividade</h5>
                            <form action="{{ route('relatorio.show') }}" method="GET">
                                <div class="input-group">
                                    <select name="atividade_id" class="form-select" required>
                                        <option value="">-- Selecione uma atividade --</option>
                                        @foreach ($eventos as $evento)
                                            <optgroup label="{{ $evento->nome }}">
                                                @foreach ($evento->atividades as $atividade)
                                                    <option value="{{ $atividade->id }}">
                                                        {{ $atividade->titulo }} ({{ \Carbon\Carbon::parse($atividade->data)->format('d/m/Y') }})
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Visualizar
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <h5 class="mb-3">Relatório Comparativo por Evento</h5>
                            <form action="{{ route('relatorio.evento-comparativo', ['eventoId' => 'placeholder']) }}" method="GET" id="eventoForm">
                                <div class="input-group">
                                    <select id="eventoSelect" class="form-select" required onchange="atualizarUrlEvento()">
                                        <option value="">-- Selecione um evento --</option>
                                        @foreach ($eventos as $evento)
                                            <option value="{{ $evento->id }}">{{ $evento->nome }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-chart-line"></i> Comparar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="mb-3">Resumo de Atividades</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Evento</th>
                                            <th>Atividade</th>
                                            <th>Data</th>
                                            <th>Inscritos</th>
                                            <th>Presentes</th>
                                            <th>Taxa de Presença</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($eventos as $evento)
                                            @forelse ($evento->atividades as $atividade)
                                                @php
                                                    $totalInscritos = $atividade->inscricoes->count();
                                                    $totalPresentes = $atividade->presencas->where('presente', true)->count();
                                                    $taxaPresenca = $totalInscritos > 0 ? round(($totalPresentes / $totalInscritos) * 100, 2) : 0;
                                                @endphp
                                                <tr>
                                                    <td>{{ $evento->nome }}</td>
                                                    <td><strong>{{ $atividade->titulo }}</strong></td>
                                                    <td>{{ \Carbon\Carbon::parse($atividade->data)->format('d/m/Y') }}</td>
                                                    <td>
                                                        <span class="badge bg-primary">{{ $totalInscritos }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success">{{ $totalPresentes }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar" role="progressbar" style="width: {{ $taxaPresenca }}%;" aria-valuenow="{{ $taxaPresenca }}" aria-valuemin="0" aria-valuemax="100">
                                                                {{ $taxaPresenca }}%
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('relatorio.show', $atividade->id) }}" class="btn btn-sm btn-info" title="Visualizar Relatório">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('relatorio.export-pdf', $atividade->id) }}" class="btn btn-sm btn-danger" title="Baixar PDF">
                                                            <i class="fas fa-file-pdf"></i>
                                                        </a>
                                                        <a href="{{ route('relatorio.export-excel', $atividade->id) }}" class="btn btn-sm btn-success" title="Baixar Excel">
                                                            <i class="fas fa-file-excel"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted">Nenhuma atividade neste evento</td>
                                                </tr>
                                            @endforelse
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">Nenhum evento disponível</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function atualizarUrlEvento() {
        const eventoId = document.getElementById('eventoSelect').value;
        if (eventoId) {
            const form = document.getElementById('eventoForm');
            form.action = form.action.replace('placeholder', eventoId);
        }
    }
</script>
@endsection
