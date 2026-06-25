<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credenciais = $request->only('email', 'password');

        if (Auth::attempt($credenciais)) {

            $request->session()->regenerate();

            $usuario = Auth::user();

            if ($usuario->tipo == 1) {
                return redirect()->route('adm.dashboard');
            }

            if ($usuario->tipo == 2) {
                return redirect()->route('aluno.paginaAluno');
            }
        }

        return back()->withErrors([
            'email' => 'Email ou senha inválidos',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(Request $request)
    {
        $googleUser = Socialite::driver('google')
            ->stateless()
            ->user();

        $admin = User::where('email', $googleUser->email)
            ->where('tipo', 1)
            ->first();

        if ($admin) {
            return redirect('/login')->withErrors([
                'email' => 'Administradores devem usar email e senha.'
            ]);
        }

        $usuario = User::updateOrCreate(
            [
                'email' => $googleUser->email
            ],
            [
                'nome' => $googleUser->name,
                'google_id' => $googleUser->id,
                'tipo' => 2,
                'senha' => bcrypt(str()->random(32)),
            ]
        );

        Auth::login($usuario);

        $request->session()->regenerate();

        return redirect()->route('aluno.pagina');
    }
}