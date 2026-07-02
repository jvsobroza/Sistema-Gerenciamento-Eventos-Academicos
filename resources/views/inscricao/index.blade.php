@extends('sidebar.sidebar')

@section('title', 'Inscrições')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <h1 class="fw-bold mb-1">Lista de Inscrições</h1>
        <p class="text-muted mb-0">Visualize as inscrições por evento e atividade.</p>
    </div>

    @forelse($eventos as $evento)

        <div class="card shadow-sm rounded-4 border-0 p-4 mb-4">

            <div class="mb-4">
                <h3 class="fw-bold mb-1">
                    {{ $evento->nome }}
                    <span class="text-muted fs-6">
                        ({{ $evento->sigla }})
                    </span>
                </h3>

                <p class="text-muted mb-0">
                    {{ date('d/m/Y', strtotime($evento->data_inicio)) }}
                    até
                    {{ date('d/m/Y', strtotime($evento->data_fim)) }}
                </p>
            </div>

            @forelse($evento->atividades as $atividade)

                <div class="mb-4">
                    <h5 class="fw-semibold mb-3">
                        {{ $atividade->titulo }}
                    </h5>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Aluno</th>
                                    <th>Email</th>
                                    <th>Data da Inscrição</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($atividade->inscricoes as $inscricao)
                                    <tr>
                                        <td>{{ $inscricao->usuario->nome }}</td>

                                        <td>{{ $inscricao->usuario->email }}</td>

                                        <td>
                                            {{ date('d/m/Y', strtotime($inscricao->data_inscricao)) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            Nenhuma inscrição nesta atividade.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            @empty
                <p class="text-center text-muted py-3 mb-0">
                    Nenhuma atividade cadastrada.
                </p>
            @endforelse

        </div>

    @empty
        <div class="card shadow-sm rounded-4 border-0 p-4">
            <p class="text-center text-muted mb-0">
                Nenhum evento encontrado.
            </p>
        </div>
    @endforelse

</div>
@endsection