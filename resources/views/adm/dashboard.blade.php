@extends('sidebar.sidebar')

@section('title', 'Dashboard Administrativa')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboardadmin.css') }}">

<div class="dashboard-wrapper">

    <header class="dashboard-header">
        <h1>Visão Geral</h1>
        <p>Acompanhe as métricas e indicadores do sistema em tempo real.</p>
    </header>

    <div class="metrics-grid">

        <div class="metric-card">
            <span class="metric-label">Alunos Cadastrados</span>
            <span class="metric-value">{{ $totalAlunos ?? 0 }}</span>
        </div>

        <div class="metric-card">
            <span class="metric-label">Eventos Criados</span>
            <span class="metric-value">{{ $totalEventos ?? 0 }}</span>
        </div>

        <div class="metric-card">
            <span class="metric-label">Total de Inscrições</span>
            <span class="metric-value">{{ $totalInscricoes ?? 0 }}</span>
        </div>

        <div class="metric-card">
            <span class="metric-label">Atividades Ativas</span>
            <span class="metric-value">{{ $totalAtividades ?? 0 }}</span>
        </div>

    </div>

    <div class="dashboard-sections-grid">

        <div class="dashboard-section-card">
            <div class="section-card-header">
                <h2>Próximos Eventos</h2>
                <a href="{{ route('evento.index') }}" class="link-ver-todos">Ver todos</a>
            </div>

            <div class="list-wrapper">
                @forelse($proximosEventos as $evento)
                <div class="list-item">
                    <div class="item-details">
                        <strong>{{ $evento->nome }}</strong>
                        <span>📍 {{ $evento->local }}</span>
                    </div>
                    <div class="item-badge">
                        {{ date('d/m/Y', strtotime($evento->data_inicio)) }}
                    </div>
                </div>
                @empty
                <p class="empty-list-text">Nenhum evento agendado para os próximos dias.</p>
                @endforelse
            </div>
        </div>

        <div class="dashboard-section-card">
            <div class="section-card-header">
                <h2>Últimos Alunos Inscritos</h2>
                <a href="{{ route('aluno.index') }}" class="link-ver-todos">Ver todos</a>
            </div>

            <div class="list-wrapper">
                @forelse($ultimosAlunos as $aluno)
                <div class="list-item">
                    <div class="item-details">
                        <strong>{{ $aluno->nome }}</strong>
                        <span>✉️ {{ $aluno->email }}</span>
                    </div>
                    <div class="item-date">
                        Inscrito em {{ $aluno->created_at->format('d/m/H:i') }}
                    </div>
                </div>
                @empty
                <p class="empty-list-text">Nenhum aluno cadastrado recentemente.</p>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection