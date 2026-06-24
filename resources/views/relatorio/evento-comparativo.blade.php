@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-chart-line"></i> Relatório Comparativo - {{ $evento->nome }}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">
                                <strong>Período:</strong> 
                                {{ \Carbon\Carbon::parse($evento->data_inicio)->format('d/m/Y') }} - 
                                {{ \Carbon\Carbon::parse($evento->data_fim)->format('d/m/Y') }}
                            </p>
                            <p class="text-muted">
                                <strong>Local:</strong> {{ $evento->local }}
                            </p>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('relatorio.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </div>

                    <hr>

                    @if ($atividades->isEmpty())
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Nenhuma atividade neste evento.
                        </div>
                    @else
                        <!-- Gráfico de Comparação -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="mb-3">Comparação de Taxa de Presença</h5>
                                <canvas id="graficoPresenca" style="max-height: 300px;"></canvas>
                            </div>
                        </div>

                        <hr>

                        <!-- Tabela Comparativa -->
                        <h5 class="mb-3">Detalhes por Atividade</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Atividade</th>
                                        <th>Data</th>
                                        <th>Horário</th>
                                        <th>Inscritos</th>
                                        <th>Presentes</th>
                                        <th>Ausentes</th>
                                        <th>Taxa de Presença</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($atividades as $item)
                                        <tr>
                                            <td><strong>{{ $item['atividade']->titulo }}</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($item['atividade']->data)->format('d/m/Y') }}</td>
                                            <td>{{ $item['atividade']->hora_inicio }} - {{ $item['atividade']->hora_fim }}</td>
                                            <td>
                                                <span class="badge bg-primary">{{ $item['total_inscritos'] }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">{{ $item['total_presentes'] }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-danger">{{ $item['total_inscritos'] - $item['total_presentes'] }}</span>
                                            </td>
                                            <td>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $item['taxa_presenca'] }}%;" aria-valuenow="{{ $item['taxa_presenca'] }}" aria-valuemin="0" aria-valuemax="100">
                                                        {{ $item['taxa_presenca'] }}%
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('relatorio.show', $item['atividade']->id) }}" class="btn btn-sm btn-info" title="Visualizar Relatório">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('relatorio.export-pdf', $item['atividade']->id) }}" class="btn btn-sm btn-danger" title="Baixar PDF">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Resumo Geral -->
                        <div class="mt-4 pt-3 border-top">
                            <div class="row">
                                @php
                                    $totalGeral = $atividades->sum('total_inscritos');
                                    $presentesGeral = $atividades->sum('total_presentes');
                                    $taxaGeral = $totalGeral > 0 ? round(($presentesGeral / $totalGeral) * 100, 2) : 0;
                                @endphp
                                <div class="col-md-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h6 class="card-title text-muted">Total de Inscritos</h6>
                                            <h3 class="text-primary">{{ $totalGeral }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h6 class="card-title text-muted">Total de Presentes</h6>
                                            <h3 class="text-success">{{ $presentesGeral }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h6 class="card-title text-muted">Total de Ausentes</h6>
                                            <h3 class="text-danger">{{ $totalGeral - $presentesGeral }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h6 class="card-title text-muted">Taxa Média</h6>
                                            <h3 class="text-info">{{ $taxaGeral }}%</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js para gráfico -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if (!$atividades->isEmpty())
        const ctx = document.getElementById('graficoPresenca').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($atividades as $item)
                        '{{ $item['atividade']->titulo }}',
                    @endforeach
                ],
                datasets: [
                    {
                        label: 'Presentes',
                        data: [
                            @foreach ($atividades as $item)
                                {{ $item['total_presentes'] }},
                            @endforeach
                        ],
                        backgroundColor: '#28a745',
                        borderColor: '#20c997',
                        borderWidth: 1
                    },
                    {
                        label: 'Ausentes',
                        data: [
                            @foreach ($atividades as $item)
                                {{ $item['total_inscritos'] - $item['total_presentes'] }},
                            @endforeach
                        ],
                        backgroundColor: '#dc3545',
                        borderColor: '#fd7e14',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Comparação de Presença por Atividade'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        stacked: true
                    },
                    x: {
                        stacked: true
                    }
                }
            }
        });
    @endif
</script>
@endsection
