<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VerificarPermissoesTest extends TestCase
{
    /** @test */
    function deve_retornar_verdadeiro_se_o_usuario_for_administrador()
    {
        //sendo que temos um usuario administrador, e outro usuario normal
        $admin = factory('App\User')->make(['permissoes'=>'administrador']);
        $usuario = factory('App\User')->make(['permissoes' => 'usuario']);

        //quando o usuario for administrador, isAdmin deve retornar verdadeiro
        $this->assertTrue($admin->isAdmin());

        //quando o usuario for normal, isAdmin deve retornar falso
        $this->assertFalse($usuario->isAdmin());
    }
}
