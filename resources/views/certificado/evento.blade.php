@extends('sidebar.sidebar')

@section('title', 'Certificados')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/showcertificado.css') }}">
    <div class="cartao-lista">
        <div class="cabecalho-lista">
            <div>
                <h1 class="titulo-pagina">
                    {{ $evento->nome }}
                </h1>
            </div>
            <a href="{{ route('certificados.index') }}" class="botao-secundario">
                Voltar
            </a>
        </div>
        @if(session('success'))
            <div class="alerta-sucesso">
                {{ session('success') }}
            </div>

        @endif
        <div class="tabela-responsiva">
            <table class="tabela-estilizada">
                <thead>
                    <tr>
                        <th>Participante</th>
                        <th class="coluna-status">
                            Status
                        </th>
                        <th class="coluna-acoes">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        @php
                            $certificado = \App\Models\Certificado::where('id_usuario', $usuario->id)
                                ->where('id_evento', $evento->id)
                                ->first();
                        @endphp
                        <tr>
                            <td>
                                <strong>{{ $usuario->nome }}</strong>
                            </td>
                            <td class="coluna-status">
                                @if($certificado)
                                    <span class="badge-sucesso">
                                        Certificado Gerado
                                    </span>
                                @else
                                    <span class="badge-pendente">
                                        Pendente
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="grupo-botoes">
                                    @if($certificado)
                                        <a href="{{ asset('storage/' . $certificado->arquivo_salvo) }}" target="_blank"
                                            class="botao-secundario-tabela">
                                            Visualizar
                                        </a>
                                    @else
                                        <a href="{{ route('certificados.pdf', [$evento->id, $usuario->id]) }}"
                                            class="botao-principal-tabela">
                                            Gerar
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection