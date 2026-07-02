@extends('sidebar.sidebar')

@section('title', 'Criar Administrador')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <h1 class="fw-bold mb-1">Criar Administrador</h1>
        <p class="text-muted mb-0">Cadastre um novo administrador no sistema.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm rounded-4 border-0 p-4">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nome</label>
                <input type="text" name="nome" class="form-control"
                    value="{{ old('nome') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control"
                    value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Senha</label>
                <input type="password" name="senha" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Confirmar Senha</label>
                <input type="password" name="senha_confirmation" class="form-control" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Salvar Administrador
                </button>

                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    Voltar
                </a>
            </div>
        </form>
    </div>

</div>
@endsection