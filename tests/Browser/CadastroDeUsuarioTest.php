<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CadastroDeUsuarioTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    function cadastra_um_usuario()
    {
        $this->browse(function (Browser $browser){
            $browser->visit("/usuarios")->clickLink('Adicionar')
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
}
