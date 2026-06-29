<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SeTEIC – Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;500&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="wrapper">
        <div class="card">
            <div class="brand">
                <img src="{{ asset('img/seteicLogoLogin.png') }}" alt="Logo SeTEIC" class="brand-logo">
            </div>

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/login" method="post">
                @csrf

                <label class="field-label" for="email">E-mail</label>
                <div class="input-wrap">
                    <input id="email" name="email" type="email" class="@error('email') is-invalid @enderror"
                        placeholder="Digite seu e-mail" value="{{ old('email') }}" autocomplete="email" required
                        autofocus />
                </div>

                <label class="field-label" for="password">Senha</label>
                <div class="input-wrap">
                    <input id="password" name="password" type="password" class="@error('password') is-invalid @enderror"
                        placeholder="Digite sua senha" autocomplete="current-password" required />

                    <button class="toggle-pass" type="button" aria-label="Mostrar senha" onclick="togglePass()">
                        <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </button>
                </div>

                <button class="btn-primary" type="submit">
                    Entrar
                </button>
            </form>

            <div class="register-area" style="text-align: center; margin-top: 15px;">
                <a href="{{ url('/') }}" class="btn-back" style="text-decoration: none; color: #666; font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 500;">
                    ← Voltar para a página inicial
                </a>
            </div>

            <p class="footer-copy">
                © 2026 SeTEIC
            </p>
        </div>
    </div>

    <script>
        function togglePass() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-10-7-10-7a18.45 18.45 0 0 1 5.06-5.94"/>
                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 10 7 10 7a18.5 18.5 0 0 1-2.16 3.19"/>
                <line x1="1" y1="1" x2="23" y2="23"/>`;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                <circle cx="12" cy="12" r="3"/>`;
            }
        }
    </script>
</body>

</html>