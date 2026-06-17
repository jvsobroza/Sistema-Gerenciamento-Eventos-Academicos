@extends('sidebar.sidebar')

@section('title', 'Criar Evento')

@section('content')
    <h1>Criar Evento</h1>
    <form method="POST" action="{{ route('evento.store') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Nome</label>
            <input type="text" name="nome" required>
        </div>

        <div>
            <label>Sigla</label>
            <input type="text" name="sigla" required>
        </div>

        <div>
            <label>Local</label>
            <input type="text" name="local" required>
        </div>

        <div>
            <label>Data Início</label>
            <input type="date" name="data_inicio" required>
        </div>

        <div>
            <label>Data Fim</label>
            <input type="date" name="data_fim" required>
        </div>

        <div>
            <label>Descrição</label>
            <textarea name="descricao" required></textarea>
        </div>

        <div>
            <label>Logo do Evento</label>
            <input type="file" name="logo">
        </div>

        <button type="submit">Salvar Evento</button>
    </form>
    <a href="{{ route('evento.index') }}">Voltar</a>
@endsection