<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return redirect('/login');
    }
}
