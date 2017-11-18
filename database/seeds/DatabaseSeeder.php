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
            'nome' => 'Admin',
            'email' => 'admin@sistema.com',
            'password' => 'secret',
            'permissoes' => 'administrador',
        ]);
    }
}
