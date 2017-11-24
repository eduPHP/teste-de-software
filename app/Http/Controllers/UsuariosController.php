<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function create()
    {
        $this->authorize('create', User::class);

        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $dados = $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|confirmed',
            'permissoes' => 'required|in:usuario,administrador',
        ]);

        User::create($dados);

        return redirect('/usuarios')->with('sucesso', 'Usuário cadastrado.');
    }


    public function edit(User $usuario)
    {
        $this->authorize('update', $usuario);

        return view('usuarios.edit', compact('usuario'));
    }

    public function update(User $usuario, Request $request)
    {
        $this->authorize('update', $usuario);

        $dados = $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'password' => 'nullable|confirmed',
            'permissoes' => 'required|in:usuario,administrador',
        ]);

        if (isset($dados['password']) && is_null($dados['password'])){
            unset($dados['password']);
        }

        $usuario->update($dados);

        return redirect('/usuarios')->with('sucesso', 'Usuário modificado');
    }

    public function index()
    {
        $usuarios = User::paginate();

        return view('usuarios.index', compact('usuarios'));
    }

    public function destroy(User $usuario)
    {
        $this->authorize('delete', $usuario);

        $usuario->delete();

        return redirect('/usuarios')->with('sucesso', 'Usuário removido');
    }
}
