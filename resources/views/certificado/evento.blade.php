@extends('sidebar.sidebar')

@section('content')

<h1>{{ $evento->nome }}</h1>

@foreach($usuarios as $usuario)

    <div>
        {{ $usuario->nome }}

        <a href="{{ route('certificados.pdf', [$evento->id, $usuario->id]) }}">
            Gerar certificado
        </a>
    </div>

@endforeach

@endsection