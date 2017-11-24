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
        //sendo que temos um administrador logado
        $this->login(factory('App\User')->states('administrador')->create());

        $this->get('/usuarios/cadastro')->assertStatus(200)->assertSee('Cadastro de usuário');

        //quando enviamos os dados para criacao de usuario
        $resposta = $this->post('/usuarios', $dados = [
            'nome' => 'John Doe',
            'email' => 'john@example.com',
            'permissoes' => 'usuario',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        //então devemos ter um novo usuario no banco com os mesmos dados
        $resposta->assertStatus(302);
        $this->assertDatabaseHas('usuarios', array_except($dados, ['password', 'password_confirmation']));
    }

    /** @test */
    function um_administrador_pode_editar_um_usuario()
    {
        $this->login(factory('App\User')->states('administrador')->create());
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
    function remocao_de_usuarios()
    {
        $this->login(factory('App\User')->states('administrador')->create());

        //sendo que temos um usuario
        $usuario = factory('App\User')->create();

        //quando enviamos delete na url
        $resposta = $this->delete("/usuarios/{$usuario->id}");

        //então deve estar ausente do banco
        $resposta->assertStatus(302);
        $resposta->assertRedirect('/usuarios')->assertSessionHas('sucesso');
        $this->assertDatabaseMissing('usuarios', ['id' => $usuario->id]);
    }


    /** @test */
    function usuarios_nao_autorizados_nao_podem_excluir_usuarios()
    {
        $this->login(factory('App\User')->create());

        //sendo que temos um usuario
        $usuario = factory('App\User')->create();

        //quando enviamos delete na url
        $resposta = $this->delete("/usuarios/{$usuario->id}");

        //então deve estar ausente do banco
        $resposta->assertStatus(403);
    }

    /** @test */
    function listagem_de_usuarios()
    {
        //sendo que temos alguns usuarios
        $usuarios = factory('App\User', 3)->create();

        //quando acessamos a lista
        $resposta = $this->get('/usuarios');

        //então devemos ter os nomes dos usuarios na tela
        $resposta->assertStatus(200);
        foreach ($usuarios as $usuario) {
            $resposta->assertSee(e($usuario->nome));
        }
    }

    /** @test */
    function ao_alterar_um_usuario_podemos_deixar_a_senha_em_branco_para_manter_a_mesma_ja_cadastrada()
    {
        $this->login(factory('App\User')->states('administrador')->create());
        //sendo que temos um usuario cadastrado
        $usuario = factory('App\User')->create();
        $dados = $usuario->toArray();
        $dados['email'] = 'john@example.com';
        $dados['password'] = null;

        //quando alteramos enviando nome, email e permissoes
        $resposta = $this->patch("/usuarios/{$usuario->id}", $dados);

        //então não devemos ter erro de senha
        $resposta->assertSessionMissing('errors');
        $this->assertDatabaseHas('usuarios', [
            'id' => $usuario->id,
            'email' => 'john@example.com',
        ]);
    }

}
