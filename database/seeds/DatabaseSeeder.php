<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory('App\User')->create([
            'nome' => 'Administrador',
            'email' => 'admin@sistema.com',
            'password' => 'secret',
            'permissoes' => 'administrador',
        ]);

        factory('App\User')->create([
            'nome' => 'Usuário Normal',
            'email' => 'user@sistema.com',
            'password' => 'secret',
            'permissoes' => 'usuario',
        ]);

    }
}
