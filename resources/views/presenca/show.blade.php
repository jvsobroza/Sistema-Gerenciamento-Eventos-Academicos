@extends('sidebar.sidebar')

@section('title', 'Lançar Presença')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <h1 class="fw-bold mb-1">{{ $atividade->titulo }}</h1>
        <p class="text-muted mb-0">Gerencie a presença dos participantes inscritos.</p>
    </div>

    <div class="card shadow-sm rounded-4 border-0 p-4">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Participante</th>
                    <th class="text-center">Ação</th>
                </tr>
            </thead>

            <tbody>
                @forelse($atividade->inscricoes as $inscricao)

                    @php
                        $presenca = $presencas[$inscricao->id_usuario] ?? null;
                    @endphp

                    <tr>
                        <td>{{ $inscricao->usuario->nome }}</td>

                        <td class="text-center">
                            @if($presenca && $presenca->presente == 1)

                                <form action="{{ route('presenca.update', $presenca->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Desmarcar Presença
                                    </button>
                                </form>

                            @else

                                <form action="{{ route('presenca.store') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="id_usuario" value="{{ $inscricao->id_usuario }}">
                                    <input type="hidden" name="id_atividade" value="{{ $atividade->id }}">

                                    <button type="submit" class="btn btn-sm btn-success">
                                        Marcar Presença
                                    </button>
                                </form>

                            @endif
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted py-4">
                            Nenhum participante inscrito.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <a href="{{ route('presenca.index') }}" class="btn btn-outline-secondary">
            Voltar
        </a>
    </div>

</div>
@endsection