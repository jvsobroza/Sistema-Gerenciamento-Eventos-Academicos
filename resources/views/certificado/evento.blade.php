@extends('sidebar.sidebar')

@section('content')

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif


    <a href="{{ route('certificados.index') }}" class="botao-secundario">
        Voltar
    </a>
    <h1>{{ $evento->nome }}</h1>

    @foreach($usuarios as $usuario)

        @php
            $certificado = \App\Models\Certificado::where('id_usuario', $usuario->id)
                ->where('id_evento', $evento->id)
                ->first();
        @endphp

        <div style="margin-bottom:10px">
            {{ $usuario->nome }}

            @if($certificado)

                <span style="color:green">
                    Certificado gerado
                </span>

                <a href="{{ asset('storage/' . $certificado->arquivo_salvo) }}" target="_blank">
                    Visualizar
                </a>

            @else

                <a href="{{ route('certificados.pdf', [$evento->id, $usuario->id]) }}">
                    Gerar certificado
                </a>

            @endif
        </div>

    @endforeach

@endsection