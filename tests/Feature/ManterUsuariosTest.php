<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ManterUsuariosTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function um_administrador_pode_criar_um_novo_usuario()
    {
        $this->get('/usuarios/cadastro')->assertStatus(200)->assertSee('Cadastro de usuário');

        //sendo que temos um administrador logado
        $this->login(factory('App\User')->states('administrador')->create());
        //quando enviamos os dados para criacao de usuario
        $resposta = $this->post('/usuarios', $dados = [
            'nome' => 'John Doe',
            'email' => 'john@example.com',
            'permissoes' => 'usuario',
            'password' => 'secret', // para não mudar o padrao do framework...
            'password_confirmation' => 'secret',
        ]);

        //então devemos ter um novo usuario no banco com os mesmos dados
        $resposta->assertStatus(302);
        $this->assertDatabaseHas('usuarios', array_except($dados, ['password', 'password_confirmation']));
    }

    /** @test */
    function um_administrador_pode_editar_um_usuario()
    {
        //sendo que temos um usuario cadastrado
        $existente = factory('App\User')->create();
        $this->get("/usuarios/{$existente->id}/edit")
            ->assertStatus(200)
            ->assertSee("Edição do usuário {$existente->nome}");

        $dados = $existente->toArray();
        $dados['email'] = 'john@example.com';
        $dados['password'] = 'secret';
        $dados['password_confirmation'] = 'secret';

        //quando enviamos info por patch
        $resposta = $this->patch("/usuarios/{$existente->id}", $dados);

        //então devemos ter os novos dados no banco
        $resposta->assertStatus(302);
        $this->assertDatabaseHas('usuarios', [
            'id' => $existente->id,
            'email' => 'john@example.com',
        ]);
    }

    /** @test */
    function listagem_de_usuarios()
    {
        $this->withoutExceptionHandling();
        //sendo que temos alguns usuarios
        $usuarios = factory('App\User',3)->create();

        //quando acessamos a lista
        $resposta = $this->get('/usuarios');

        //então devemos ter os nomes dos usuarios na tela
        $resposta->assertStatus(200);
        foreach ($usuarios as $usuario){
            $resposta->assertSee($usuario->nome);
        }
    }

}
