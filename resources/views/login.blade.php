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

                <a href="#" class="forgot">
                    Esqueceu sua senha?
                </a>

                <button class="btn-primary" type="submit">
                    Entrar
                </button>
            </form>

            <div class="register-area">

                <p class="register-text">
                    Ainda não possui uma conta?
                </p>

                <a href="/register" class="btn-secondary">
                    Criar nova conta
                </a>

                </form>
                <a href="{{ url('auth/google/redirect') }}" class="btn-google">
                    <svg viewBox="0 0 48 48" width="18" height="18">
                        <path fill="#FFC107"
                            d="M43.6 20.5H42V20H24v8h11.3C33.7 32.4 29.3 35 24 35c-6.1 0-11-4.9-11-11s4.9-11 11-11c2.8 0 5.3 1 7.3 2.7l5.7-5.7C33.6 6.5 29 4.5 24 4.5 13.2 4.5 4.5 13.2 4.5 24S13.2 43.5 24 43.5 43.5 34.8 43.5 24c0-1.2-.1-2.4-.3-3.5z" />
                        <path fill="#FF3D00"
                            d="M6.3 14.7l6.6 4.8C14.6 16 18.9 13 24 13c2.8 0 5.3 1 7.3 2.7l5.7-5.7C33.6 6.5 29 4.5 24 4.5c-7.7 0-14.3 4.4-17.7 10.2z" />
                        <path fill="#4CAF50"
                            d="M24 43.5c5 0 9.5-1.9 12.9-5.1l-6-5c-1.9 1.3-4.3 2.1-6.9 2.1-5.3 0-9.7-3.5-11.3-8.4l-6.6 5.1C9.6 39 16.3 43.5 24 43.5z" />
                        <path fill="#1976D2"
                            d="M43.6 20.5H42V20H24v8h11.3c-.8 2.3-2.3 4.3-4.3 5.7l6 5c3.5-3.2 5.5-8 5.5-13.7 0-1.2-.1-2.4-.3-3.5z" />
                    </svg>
                    Entrar com o Google
                </a>

                <div class="register-area"></div>
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