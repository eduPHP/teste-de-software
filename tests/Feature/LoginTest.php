<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function um_usuario_pode_fazer_login()
    {
        $usuario = factory('App\User')->create([
            'email' => 'admin@sistema.com',
        ]);

        $this->get('/')->assertRedirect('/login');

        $this->post('/login', [
            'email' => 'admin@sistema.com',
            'password' => 'secret',
        ]);

        $this->assertEquals($usuario->id, auth()->id());
    }

    /** @test */
    function um_usuario_logado_pode_fazer_logout()
    {
        $this->withoutExceptionHandling();
        //sendo que temos um usuario logado
        $this->login();
        $this->assertNotNull(auth()->id());

        //quando enviamos post para logout
        $this->post('/logout');

        //então não devemos ter um usuario logado
        $this->assertNull(auth()->id());
    }

    /** @test */
    function um_usuario_pode_solicitar_um_email_de_recuperacao_de_senha()
    {
        // TODO
        //sendo que temos uma conta que não sabemos a senha
        //quando acessamos /password/reset e solicitamos email de recuperação
        //então um email deve ter sido enviado, e teremos um token armazenado
    }
}
