<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Evento;


class UserController extends Controller
{

    public function home()
    {
        $eventos = Evento::with('atividades')
            ->where('data_fim', '>=', date('Y-m-d'))
            ->get();

        return view('welcome', compact('eventos'));
    }

    public function index()
    {
        $users = User::where('tipo', 1)->get();
        return view('users.index', compact('users'));
    }

    public function alunos()
    {
        $users = User::where('tipo', 2)->get();
        return view('aluno.index', compact('users'));
    }

    public function paginaAlunos()
    {
        $eventos = Evento::with('atividades')->get();

        return view('aluno.paginaAluno', compact('eventos'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuario,email',
            'senha' => 'required|min:6|confirmed',
        ]);

        User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => bcrypt($request->senha),
            'tipo' => 1,
        ]);

        return redirect()->route('users.index')->with('success', 'Administrador criado com sucesso!');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuario,email,' . $id,
            'senha' => 'nullable|min:6|confirmed',
        ]);

        $user->nome = $request->nome;
        $user->email = $request->email;

        if ($request->senha) {
            $user->senha = bcrypt($request->senha);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Administrador atualizado!');
    }

    public function destroy(User $user)
    {
        $tipo = $user->tipo;

        $user->delete();

        if ($tipo == 1) {
            return redirect()->route('users.index');
        }

        return redirect()->route('aluno.index');
    }

    public function editarConta()
    {
        $user = auth()->user();

        return view('aluno.edit', compact('user'));
    }

    public function atualizarConta(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255'
        ]);

        auth()->user()->update([
            'nome' => $request->nome
        ]);

        return redirect()->route('aluno.pagina')
            ->with('success', 'Nome atualizado com sucesso!');
    }

}
