<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'permissoes' => 'required|in:usuario,administrador',
        ]);
        User::create($dados);

        return redirect('/usuarios')->with('sucesso', 'Usuario cadastrado.');
    }


    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(User $usuario, Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'permissoes' => 'required|in:usuario,administrador',
        ]);

        $usuario->update($dados);

        return redirect('/usuarios')->with('sucesso','Usuario modificado');
    }

    public function index()
    {
        $usuarios = User::paginate();

        return view('usuarios.index',compact('usuarios'));
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect('/usuarios')->with('sucesso','Usuario removido');
    }
}
