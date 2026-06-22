@extends('sidebar.sidebar')

@section('title', 'Inscrições')

@section('content')

    <h1>Lista de Inscrições</h1>

    @forelse($eventos as $evento)

        <h2>
            {{ $evento->nome }}
            ({{ $evento->sigla }})
        </h2>

        <p>
            {{ date('d/m/Y', strtotime($evento->data_inicio)) }}
            até
            {{ date('d/m/Y', strtotime($evento->data_fim)) }}
        </p>

        @forelse($evento->atividades as $atividade)

            <h3>
                {{ $atividade->titulo }}
            </h3>

            <table border="1" cellpadding="8" cellspacing="0" width="100%">
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
                                {{ \Carbon\Carbon::parse($inscricao->data_inscricao)->format('d/m/Y') }}
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="3">
                                Nenhuma inscrição nesta atividade.
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>

            <br>

        @empty

            <p>Nenhuma atividade cadastrada.</p>

        @endforelse

        <hr>

    @empty

        <p>Nenhum evento encontrado.</p>

    @endforelse

@endsection