<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DesligamentoAssociadoTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function metodo_desligar_deve_modificar_o_parametro_desligado_para_verdadeiro()
    {
        //sendo que temos um associado com desligado = false
        $naoDesligado = factory('App\Associado')->create(['desligado' => false]);

        //quando executamos o metod desligar no model Associado
        $naoDesligado->desligar();

        //então devemos ter desligado = true no banco de dados
        $this->assertDatabaseHas('associados', [
            'id' => $naoDesligado->id,
            'desligado' => true,
        ]);
    }
    
    /** @test */
    function metodo_religar_deve_modificar_o_parametro_desligado_para_falso()
    {
        //sendo que temos um associado com desligado = false
        $desligado = factory('App\Associado')->create(['desligado' => true]);

        //quando executamos o metod religar no model Associado
        $desligado->religar();

        //então devemos ter desligado = false no banco de dados
        $this->assertDatabaseHas('associados', [
            'id' => $desligado->id,
            'desligado' => false,
        ]);
    }
}
