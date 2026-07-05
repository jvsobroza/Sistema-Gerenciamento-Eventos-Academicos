@extends('sidebar.sidebar')

@section('title', 'Alunos')

@section('content')

    <div class="container-fluid py-4">
        <div class="border-bottom border-primary border-opacity-25 pb-3 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-1">
                        <i class="bi bi-mortarboard-fill text-primary"></i>
                        Alunos
                    </h2>
                    <p class="text-muted mb-0">
                        Gerencie os alunos cadastrados no sistema.
                    </p>
                </div>
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
                    Lista de Alunos
                </h5>

                <span class="badge bg-light text-primary">
                    {{ $users->count() }}
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th width="35%">
                                <i class="bi bi-person-fill me-2"></i>
                                Nome
                            </th>
                            <th>
                                <i class="bi bi-envelope-fill me-2"></i>
                                E-mail
                            </th>
                            <th width="150" class="text-center">
                                <i class="bi bi-gear-fill me-2"></i>
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $user->nome }}
                                </td>
                                <td class="text-muted">
                                    {{ $user->email }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Tem certeza que deseja excluir este aluno?')">

                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <i class="bi bi-person-x display-5 text-secondary"></i>
                                    <p class="mt-3 mb-0 text-muted">
                                        Nenhum aluno encontrado.
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