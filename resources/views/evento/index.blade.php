@extends('sidebar.sidebar')

@section('title', 'Eventos')

@section('content')

    <div class="container-fluid py-4">
        <div class="border-bottom border-primary border-opacity-25 pb-3 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-1">
                        <i class="bi bi-calendar-event-fill text-primary"></i>
                        Eventos
                    </h2>
                    <p class="text-muted mb-0">
                        Gerencie os eventos cadastrados no sistema.
                    </p>
                </div>
                <a href="{{ route('evento.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>
                    Novo Evento
                </a>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success shadow-sm border-success border-opacity-25">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger shadow-sm border-danger border-opacity-25">
                <i class="bi bi-x-circle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif
        <div class="card border-primary border-opacity-25 shadow-sm">

            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-list-ul me-2"></i>
                    Lista de Eventos
                </h5>
                <span class="badge bg-light text-primary">
                    {{ $eventos->count() }}
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Nome</th>
                            <th>Sigla</th>
                            <th>Local</th>
                            <th>Início</th>
                            <th>Fim</th>
                            <th class="text-center" width="160">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($eventos as $evento)

                            <tr>
                                <td class="fw-semibold">
                                    {{ $evento->nome }}
                                </td>
                                <td>
                                    {{ $evento->sigla }}
                                </td>
                                <td class="text-muted">
                                    {{ $evento->local }}
                                </td>
                                <td>
                                    {{ date('d/m/Y', strtotime($evento->data_inicio)) }}
                                </td>
                                <td>
                                    {{ date('d/m/Y', strtotime($evento->data_fim)) }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('evento.edit', $evento->id) }}"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('evento.destroy', $evento->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Deseja excluir este evento?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="bi bi-calendar-x display-5 text-secondary"></i>
                                    <p class="mt-3 mb-0 text-muted">
                                        Nenhum evento cadastrado.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection