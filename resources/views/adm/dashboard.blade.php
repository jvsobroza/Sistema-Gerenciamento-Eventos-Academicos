@extends('sidebar.sidebar')

@section('title', 'Dashboard Administrativa')

@section('content')

    <div class="container-fluid py-4">

        <div class="border-bottom border-success border-opacity-25 pb-3 mb-4">
            <h2 class="fw-bold mb-1">
                <i class="bi bi-speedometer2 text-success"></i>
                Dashboard
            </h2>
            <p class="text-muted mb-0">
                Acompanhe as métricas e indicadores do sistema.
            </p>
        </div>
        <div class="row g-4 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card border-success border-opacity-25 shadow-sm h-100">
                    <div class="card-body">
                        <small class="text-muted">
                            Alunos Cadastrados
                        </small>
                        <h2 class="fw-bold mt-2 mb-0 text-success">
                            {{ $totalAlunos ?? 0 }}
                        </h2>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-success border-opacity-25 shadow-sm h-100">
                    <div class="card-body">

                        <small class="text-muted">
                            Eventos Criados
                        </small>

                        <h2 class="fw-bold mt-2 mb-0 text-primary">
                            {{ $totalEventos ?? 0 }}
                        </h2>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-success border-opacity-25 shadow-sm h-100">
                    <div class="card-body">

                        <small class="text-muted">
                            Total de Inscrições
                        </small>

                        <h2 class="fw-bold mt-2 mb-0 text-warning">
                            {{ $totalInscricoes ?? 0 }}
                        </h2>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-success border-opacity-25 shadow-sm h-100">
                    <div class="card-body">
                        <small class="text-muted">
                            Atividades Ativas
                        </small>
                        <h2 class="fw-bold mt-2 mb-0 text-danger">
                            {{ $totalAtividades ?? 0 }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-success border-opacity-25 shadow-sm h-100">
                    <div
                        class="card-header bg-white d-flex justify-content-between align-items-center border-success border-opacity-25">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-calendar-event text-success"></i>
                            Próximos Eventos
                        </h5>
                        <a href="{{ route('evento.index') }}" class="btn btn-sm btn-outline-success">
                            Ver todos
                        </a>
                    </div>
                    <div class="card-body">
                        @forelse($proximosEventos as $evento)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                                <div>
                                    <div class="fw-semibold">
                                        {{ $evento->nome }}
                                    </div>
                                    <small class="text-muted">
                                        <i class="bi bi-geo-alt"></i>
                                        {{ $evento->local }}
                                    </small>
                                </div>
                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    {{ date('d/m/Y', strtotime($evento->data_inicio)) }}
                                </span>
                            </div>
                        @empty
                            <div class="text-center text-muted py-5">
                                Nenhum evento encontrado.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-success border-opacity-25 shadow-sm h-100">
                    <div
                        class="card-header bg-white d-flex justify-content-between align-items-center border-success border-opacity-25">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-people text-success"></i>
                            Últimos Alunos
                        </h5>
                        <a href="{{ route('aluno.index') }}" class="btn btn-sm btn-outline-success">
                            Ver todos
                        </a>
                    </div>
                    <div class="card-body">
                        @forelse($ultimosAlunos as $aluno)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                                <div>
                                    <div class="fw-semibold">
                                        {{ $aluno->nome }}
                                    </div>
                                    <small class="text-muted">
                                        {{ $aluno->email }}
                                    </small>
                                </div>
                                <small class="text-muted">
                                    {{ $aluno->created_at->format('d/m H:i') }}
                                </small>
                            </div>
                        @empty
                            <div class="text-center text-muted py-5">
                                Nenhum aluno cadastrado.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection