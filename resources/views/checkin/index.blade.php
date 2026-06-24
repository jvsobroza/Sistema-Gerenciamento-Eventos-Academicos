@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-qrcode"></i> Check-in por QR Code
                    </h4>
                </div>
                <div class="card-body">
                    @if ($atividades->isEmpty())
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Nenhuma atividade com QR code disponível.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Atividade</th>
                                        <th>Evento</th>
                                        <th>Data</th>
                                        <th>Horário</th>
                                        <th>Local</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($atividades as $atividade)
                                        <tr>
                                            <td>
                                                <strong>{{ $atividade->titulo }}</strong>
                                            </td>
                                            <td>{{ $atividade->evento->nome }}</td>
                                            <td>{{ \Carbon\Carbon::parse($atividade->data)->format('d/m/Y') }}</td>
                                            <td>{{ $atividade->hora_inicio }} - {{ $atividade->hora_fim }}</td>
                                            <td>{{ $atividade->local }}</td>
                                            <td>
                                                <a href="{{ route('checkin.show', $atividade->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-qrcode"></i> Check-in
                                                </a>
                                                <a href="{{ route('qrcode.show', $atividade->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> Ver QR
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
