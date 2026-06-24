@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0">
                                <i class="fas fa-chart-bar"></i> Relatório de Presença
                            </h4>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('relatorio.export-pdf', $atividade->id) }}" class="btn btn-sm btn-danger">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                            <a href="{{ route('relatorio.export-excel', $atividade->id) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-file-excel"></i> Excel
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Informações da Atividade -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>{{ $atividade->titulo }}</h5>
                            <p class="text-muted mb-1">
                                <strong>Evento:</strong> {{ $atividade->evento->nome }}
                            </p>
                            <p class="text-muted mb-1">
                                <strong>Data:</strong> {{ \Carbon\Carbon::parse($atividade->data)->format('d/m/Y') }}
                            </p>
                            <p class="text-muted mb-1">
                                <strong>Horário:</strong> {{ $atividade->hora_inicio }} - {{ $atividade->hora_fim }}
                            </p>
                            <p class="text-muted">
                                <strong>Local:</strong> {{ $atividade->local }}
                            </p>
                        </div>

                        <!-- Estatísticas -->
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h6 class="card-title text-muted">Total de Inscritos</h6>
                                            <h3 class="text-primary">{{ $totalInscritos }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h6 class="card-title text-muted">Total de Presentes</h6>
                                            <h3 class="text-success">{{ $totalPresentes }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">Taxa de Presença</h6>
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $taxaPresenca }}%;" aria-valuenow="{{ $taxaPresenca }}" aria-valuemin="0" aria-valuemax="100">
                                                <strong>{{ $taxaPresenca }}%</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Tabela de Presenças -->
                    <h5 class="mb-3">Detalhes de Presença</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Data de Inscrição</th>
                                    <th>Status</th>
                                    <th>Data de Presença</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dados as $index => $dado)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><strong>{{ $dado['nome'] }}</strong></td>
                                        <td>{{ $dado['email'] }}</td>
                                        <td>
                                            @if ($dado['data_inscricao'])
                                                {{ \Carbon\Carbon::parse($dado['data_inscricao'])->format('d/m/Y H:i') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($dado['presente'])
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check"></i> Presente
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times"></i> Ausente
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($dado['data_presenca'])
                                                {{ \Carbon\Carbon::parse($dado['data_presenca'])->format('d/m/Y H:i') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Nenhum participante inscrito nesta atividade</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Resumo -->
                    <div class="mt-4 pt-3 border-top">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted">
                                    <strong>Ausentes:</strong> {{ $totalInscritos - $totalPresentes }}
                                </p>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('relatorio.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Voltar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
