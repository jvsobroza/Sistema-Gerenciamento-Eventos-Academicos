@extends('sidebar.sidebar')

@section('content')

<h1>Eventos</h1>

@foreach($eventos as $evento)

    <div>
        <h3>{{ $evento->nome }}</h3>

        <a href="{{ route('certificados.evento', $evento->id) }}">
            Ver participantes
        </a>
    </div>

@endforeach

@endsection