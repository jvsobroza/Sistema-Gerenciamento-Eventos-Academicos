<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SeTEIC – Verificar Certificado</title>

    <link href="https://fonts.googleapis.com/css2?family=Sora:wght=600;700;800&family=Inter:wght=400;500&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="wrapper">
        <div class="card">
            <div class="brand">
                <img src="{{ asset('img/seteicLogoLogin.png') }}" alt="Logo SeTEIC" class="brand-logo">
            </div>

            <h1 style="font-family: 'Sora', sans-serif; font-size: 22px; color: #1a1a1a; text-align: center; margin-bottom: 20px; font-weight: 700;">
                Verificar Certificado
            </h1>

            @if(session('success'))
                <div class="success-box" style="background-color: #e6f4ea; border-left: 4px solid #137333; color: #137333; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-family: 'Inter', sans-serif; font-size: 14px;">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="error-box">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('certificado.verifica') }}">
                @csrf

                <label class="field-label" for="codigo_verificacao">Código do certificado</label>
                <div class="input-wrap" style="margin-bottom: 20px;">
                    <input 
                        id="codigo_verificacao"
                        type="text" 
                        name="codigo_verificacao" 
                        placeholder="Ex: CERT-1234-ABCD"
                        value="{{ old('codigo_verificacao') }}" 
                        required 
                        autofocus 
                    />
                </div>

                <button class="btn-primary" type="submit">
                    Verificar Certificado
                </button>
            </form>

            <div class="register-area" style="text-align: center; margin-top: 20px;">
                <a href="{{ url('/') }}" class="btn-back" style="text-decoration: none; color: #666; font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 500;">
                    ← Voltar para a página inicial
                </a>
            </div>

            <p class="footer-copy">
                © 2026 SeTEIC
            </p>
        </div>
    </div>
</body>

</html>