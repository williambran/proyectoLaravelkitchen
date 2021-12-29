<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//Aqui pasamos los seeder para crearlos en las bases de datos
        $this->call(CategoriasSeeder::class);
        $this->call(UsuarioSeeder::class);
        // $this->call(UserSeeder::class);
    }
}
