<?php

namespace Tests\Feature;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
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
        $usuario = factory('App\User')->create([
            'password' => bcrypt(str_random()),
        ]);

        Notification::fake();

        $this->get('/password/reset')->assertStatus(200);

        $this->post('/password/email', [
            'email' => $usuario->email,
        ])->assertStatus(302)
            ->assertSessionHas('status');

        Notification::assertSentTo(
            [$usuario], ResetPassword::class
        );


    }
}
