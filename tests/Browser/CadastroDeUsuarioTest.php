<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CadastroDeUsuarioTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testLoginDeUsuario()
    {
        $user = factory(User::class)->states('administrador')->create([
            'email' => 'admin@sistema.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/');
        });
    }

    function testCadastraUmUsuario()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(factory(User::class)->states('administrador')->create())
                ->visit("/usuarios")->clickLink('Adicionar')
                ->assertPathIs('/usuarios/cadastro')
                ->assertSee('Cadastro de usuário')
                ->type('nome','John Doe')
                ->type('email','john@example.com')
                ->select('permissoes','usuario')
                ->type('password','secret')
                ->type('password_confirmation','secret')
                ->press('Gravar')
                ->assertPathIs('/usuarios')
                ->assertSee("John Doe")
                ->assertSee("Usuário cadastrado");
        });
    }

    function testConfirmacaoAoRemoverUmUsuario()
    {
        $usuario = factory(User::class)->create();
        $this->browse(function (Browser $browser) use ($usuario) {
            $browser->loginAs(factory(User::class)->states('administrador')->create());

            $browser->visit("/usuarios")->click('.btn-danger');

            $browser->driver->switchTo()->alert()->dismiss();

            $this->assertDatabaseHas('usuarios', ['id' => $usuario->id]);

            $browser->click('.btn-danger');

            $browser->driver->switchTo()->alert()->accept();

            $browser->driver->switchTo()->defaultContent();

            $browser->assertSee('Usuário removido');
        });
        $this->assertDatabaseMissing('usuarios', ['id' => $usuario->id]);
    }
}
