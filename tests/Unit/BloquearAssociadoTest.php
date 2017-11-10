<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BloquearAssociadoTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function metodo_bloquear_deve_modificar_o_parametro_bloqueado_para_verdadeiro()
    {
        //sendo que temos um associado com desligado = false
        $naoDesligado = factory('App\Associado')->create(['bloqueado' => false]);

        //quando executamos o metod bloquear no model Associado
        $naoDesligado->bloquear();

        //então devemos ter bloqueado = true no banco de dados
        $this->assertDatabaseHas('associados', [
            'id' => $naoDesligado->id,
            'bloqueado' => true,
        ]);
    }

    /** @test */
    function metodo_desbloquear_deve_modificar_o_parametro_bloqueado_para_falso()
    {
        //sendo que temos um associado com desligado = false
        $desligado = factory('App\Associado')->create(['bloqueado' => true]);

        //quando executamos o metod desbloquear no model Associado
        $desligado->desbloquear();

        //então devemos ter bloqueado = false no banco de dados
        $this->assertDatabaseHas('associados', [
            'id' => $desligado->id,
            'bloqueado' => false,
        ]);
    }
}
