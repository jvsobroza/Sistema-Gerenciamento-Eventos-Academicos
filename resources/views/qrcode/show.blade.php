extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">QR Code - Check-in da Atividade</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>{{ $atividade->titulo }}</h5>
                            <p class="text-muted mb-1">
                                <strong>Evento:</strong> {{ $atividade->evento->nome }}
                            </p>
                            <p class="text-muted mb-1">
                                <strong>Data:</strong> {{ \Carbon\Carbon::parse($atividade->data)->format('d/m/Y') }}
                            </p>
                            <p class="text-muted mb-1">
                                <strong>Horário:</strong> {{ $atividade->hora_inicio }} - {{ $atividade->hora_fim }}
                            </p>
                            <p class="text-muted">
                                <strong>Local:</strong> {{ $atividade->local }}
                            </p>
                        </div>
                    </div>

                    <div class="text-center mb-4">
                        @if ($atividade->qr_code)
                            <div class="qr-code-container" style="display: inline-block; padding: 20px; background: white; border: 2px solid #ddd; border-radius: 8px;">
                                <img src="{{ $atividade->qr_code }}" alt="QR Code" style="width: 300px; height: 300px;">
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> QR code não foi gerado para esta atividade.
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-muted small">
                                <strong>Hash do QR Code:</strong><br>
                                <code>{{ $atividade->qr_code_hash }}</code>
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('qrcode.download', $atividade->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-download"></i> Baixar QR Code
                                </a>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('checkin.show', $atividade->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-qrcode"></i> Fazer Check-in
                                </a>
                                <a href="{{ route('atividades.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i> Voltar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .qr-code-container {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .qr-code-container img {
        display: block;
        margin: 0 auto;
    }
</style>
@endsection