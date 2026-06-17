@extends('sidebar.sidebar')

@section('title', 'Editar Evento')

@section('content')
    <h1>Editar Evento</h1>

    <form method="POST" action="{{ route('evento.update', $evento->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label>Nome</label>
            <input type="text" name="nome" value="{{ $evento->nome }}" required>
        </div>

        <div>
            <label>Sigla</label>
            <input type="text" name="sigla" value="{{ $evento->sigla }}" required>
        </div>

        <div>
            <label>Local</label>
            <input type="text" name="local" value="{{ $evento->local }}" required>
        </div>

        <div>
            <label>Data Início</label>
            <input type="date" name="data_inicio" value="{{ $evento->data_inicio }}" required>
        </div>

        <div>
            <label>Data Fim</label>
            <input type="date" name="data_fim" value="{{ $evento->data_fim }}" required>
        </div>

        <div>
            <label>Descrição</label>
            <textarea name="descricao" required>{{ $evento->descricao }}</textarea>
        </div>

        <div>
            <label>Logo Atual</label><br>

            @if($evento->logo)
                <img src="{{ asset('storage/' . $evento->logo) }}" width="120">
            @else
                <p>Sem logo</p>
            @endif
        </div>

        <div>
            <label>Trocar Logo</label>
            <input type="file" name="logo">
        </div>

        <button type="submit">Atualizar Evento</button>
    </form>

    <a href="{{ route('evento.index') }}">Voltar</a>
@endsection