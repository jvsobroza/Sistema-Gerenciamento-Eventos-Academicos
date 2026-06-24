@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-qrcode"></i> Check-in - {{ $atividade->titulo }}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Evento:</strong> {{ $atividade->evento->nome }}</p>
                            <p class="mb-1"><strong>Data:</strong> {{ \Carbon\Carbon::parse($atividade->data)->format('d/m/Y') }}</p>
                            <p class="mb-1"><strong>Horário:</strong> {{ $atividade->hora_inicio }} - {{ $atividade->hora_fim }}</p>
                            <p class="mb-1"><strong>Local:</strong> {{ $atividade->local }}</p>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                <strong>Total de Inscritos:</strong> {{ $inscritos->count() }}
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs mb-4" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="scanner-tab" data-bs-toggle="tab" data-bs-target="#scanner" type="button" role="tab">
                                <i class="fas fa-camera"></i> Scanner QR Code
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="manual-tab" data-bs-toggle="tab" data-bs-target="#manual" type="button" role="tab">
                                <i class="fas fa-keyboard"></i> Check-in Manual
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Scanner QR Code -->
                        <div class="tab-pane fade show active" id="scanner" role="tabpanel">
                            <div class="row">
                                <div class="col-md-8">
                                    <div id="qr-reader" style="width: 100%; height: 400px; border: 2px solid #ddd; border-radius: 8px; background: #f8f9fa;"></div>
                                    <p class="text-muted text-center mt-3">
                                        <small>Aponte a câmera para o QR code para fazer o check-in automaticamente</small>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <h6 class="mb-0">Informações</h6>
                                        </div>
                                        <div class="card-body">
                                            <p class="small mb-2">
                                                <strong>Status:</strong> <span id="scanner-status" class="badge bg-warning">Aguardando...</span>
                                            </p>
                                            <p class="small mb-2">
                                                <strong>Última Leitura:</strong> <span id="last-scan" class="text-muted">-</span>
                                            </p>
                                            <button type="button" class="btn btn-sm btn-warning w-100" onclick="toggleCamera()">
                                                <i class="fas fa-power-off"></i> Desligar Câmera
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Check-in Manual -->
                        <div class="tab-pane fade" id="manual" role="tabpanel">
                            <form action="{{ route('checkin.store') }}" method="POST" class="row g-3">
                                @csrf
                                <input type="hidden" name="atividade_id" value="{{ $atividade->id }}">
                                <input type="hidden" name="hash" value="{{ $hash }}">

                                <div class="col-md-8">
                                    <label for="usuario_id" class="form-label">Selecione o Participante</label>
                                    <select name="usuario_id" id="usuario_id" class="form-select" required>
                                        <option value="">-- Escolha um participante --</option>
                                        @foreach ($inscritos as $inscricao)
                                            <option value="{{ $inscricao->id_usuario }}">
                                                {{ $inscricao->usuario->nome }} ({{ $inscricao->usuario->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fas fa-check"></i> Registrar Presença
                                    </button>
                                </div>
                            </form>

                            @if ($inscritos->isEmpty())
                                <div class="alert alert-warning mt-3">
                                    <i class="fas fa-exclamation-triangle"></i> Nenhum participante inscrito nesta atividade.
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Tabela de Presenças Registradas -->
                    <div class="mt-5 pt-4 border-top">
                        <h5 class="mb-3">Presenças Registradas</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>Participante</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Data/Hora</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($inscritos as $inscricao)
                                        @php
                                            $presenca = $presencas->get($inscricao->id_usuario);
                                        @endphp
                                        <tr>
                                            <td>{{ $inscricao->usuario->nome }}</td>
                                            <td>{{ $inscricao->usuario->email }}</td>
                                            <td>
                                                @if ($presenca && $presenca->presente)
                                                    <span class="badge bg-success">Presente</span>
                                                @else
                                                    <span class="badge bg-secondary">Ausente</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($presenca && $presenca->presente)
                                                    {{ \Carbon\Carbon::parse($presenca->created_at)->format('d/m/Y H:i') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($presenca && $presenca->presente)
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="desfazCheckin({{ $inscricao->id_usuario }})">
                                                        <i class="fas fa-undo"></i> Desfazer
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Nenhum participante inscrito</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ route('checkin.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para QR Code Scanner -->
<script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
<script>
    let html5QrcodeScanner;
    let cameraActive = true;

    document.addEventListener('DOMContentLoaded', function() {
        initializeScanner();
    });

    function initializeScanner() {
        html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader",
            { fps: 10, qrbox: { width: 250, height: 250 } },
            false
        );

        html5QrcodeScanner.render(onScanSuccess, onScanError);
    }

    function onScanSuccess(decodedText, decodedResult) {
        // Extrai o usuário_id do QR code ou usa como referência
        console.log('QR Code lido:', decodedText);
        
        // Atualiza o status
        document.getElementById('scanner-status').textContent = 'Lido com sucesso!';
        document.getElementById('scanner-status').className = 'badge bg-success';
        document.getElementById('last-scan').textContent = new Date().toLocaleTimeString('pt-BR');

        // Aqui você pode processar o QR code
        // Por exemplo, extrair dados e fazer o check-in automaticamente
    }

    function onScanError(error) {
        // Silenciosamente ignora erros de scanning
    }

    function toggleCamera() {
        if (cameraActive) {
            html5QrcodeScanner.pause();
            cameraActive = false;
            document.getElementById('scanner-status').textContent = 'Desligada';
            document.getElementById('scanner-status').className = 'badge bg-danger';
        } else {
            html5QrcodeScanner.resume();
            cameraActive = true;
            document.getElementById('scanner-status').textContent = 'Ativa';
            document.getElementById('scanner-status').className = 'badge bg-success';
        }
    }

    function desfazCheckin(usuarioId) {
        if (confirm('Tem certeza que deseja desfazer o check-in deste participante?')) {
            fetch('{{ route("checkin.undo") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    usuario_id: usuarioId,
                    atividade_id: {{ $atividade->id }}
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Erro: ' + data.message);
                }
            })
            .catch(error => console.error('Erro:', error));
        }
    }
</script>

<style>
    #qr-reader {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
@endsection
