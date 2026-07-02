<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Evento;
use App\Models\Certificado;
use App\Models\Inscricao;

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
        $userId = auth()->id();
        $eventosInscritos = Evento::with(['atividades' => function ($query) use ($userId) {
            $query->whereHas('inscricoes', function ($q) use ($userId) {
                $q->where('id_usuario', $userId);
            });
        }])
            ->whereHas('atividades.inscricoes', function ($query) use ($userId) {
                $query->where('id_usuario', $userId);
            })
            ->orderBy('data_inicio')
            ->get();
        $proximosEventos = Evento::with('atividades')
            ->whereDate('data_fim', '>=', today())
            ->whereDoesntHave('atividades.inscricoes', function ($query) use ($userId) {
                $query->where('id_usuario', $userId);
            })
            ->orderBy('data_inicio')
            ->get();
        $alunoAtividadesCount = Inscricao::where('id_usuario', $userId)->count();
        $alunoCertificadosCount = Certificado::where('id_usuario', $userId)->count();
        $alunoEventosCount = $eventosInscritos->count(); // Usa direto o count da coleção acima

        return view('aluno.paginaAluno', compact(
            'eventosInscritos',
            'proximosEventos',
            'alunoEventosCount',
            'alunoAtividadesCount',
            'alunoCertificadosCount'
        ));
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
        ], [
            'nome.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Digite um email válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'senha.required' => 'A senha é obrigatória.',
            'senha.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'senha.confirmed' => 'As senhas não conferem.',
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
        ], [
            'nome.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Digite um email válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'senha.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'senha.confirmed' => 'As senhas não conferem.',
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
        if ($user->tipo == 2 && Certificado::where('id_usuario', $user->id)->exists()) {
            return redirect()->route('aluno.index')
                ->with('error', 'Não é possível excluir este aluno pois ele possui certificados.');
        }

        $user->delete();

        if ($user->tipo == 1) {
            return redirect()->route('users.index')
                ->with('success', 'Usuário excluído com sucesso!');
        }

        return redirect()->route('aluno.index')
            ->with('success', 'Usuário excluído com sucesso!');
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
