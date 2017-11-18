<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissoesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function um_usuario_normal_nao_pode_adicionar_outro_usuario()
    {
        //sendo que temos um usuario logado
        $this->login();
        $adicionar = [
            'nome'=>'John Doe'
        ];

        //quando enviamos dados para adicionar outro usuario
        $resposta = $this->post('/usuarios',$adicionar);

        //então devemos ter permissao negada (403)
        $resposta->assertStatus(403);
    }

    /** @test */
    function um_usuario_pode_editar_o_proprio_perfil()
    {
        $this->withoutExceptionHandling();
        //sendo que temos um usuario logado
        $usuario = factory(User::class)->create();

        //quando enviamos b.b.b
        $dados = $usuario->toArray();
        $dados['nome'] = 'John Doe';

        $resposta = $this->login($usuario)->patch("/usuarios/{$usuario->id}", $dados);

        //então deve estar mudado no banco
        $resposta->assertStatus(302);
        $this->assertDatabaseHas('usuarios',['nome'=>'John Doe']);
    }
}
