<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*  // Meter usuarios ala base de datos
        DB::table('Users')->insert([
            'name'=> 'william',
            'email'=> 'prueba@gmail.com',
            'password'=> Hash::make('12345678'),
            'url'=> 'https://www.youtube.com/watch?v=i-bPz6KfRrM&ab_channel=MarcaClaro',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('Users')->insert([
            'name'=> 'pablo',
            'email'=> 'prueba1@gmail.com',
            'password'=> Hash::make('12345678'),
            'url'=> 'https://www.youtube.com/watch?v=i-bPz6KfRrM&ab_channel=MarcaClaro',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);*/

        //Crear Usuarios con perfil
        $user = User::create([
            'name'=> 'william',
            'email'=> 'prueba@gmail.com',
            'password'=> Hash::make('12345678'),
            'url'=> 'https://www.youtube.com/watch?v=i-bPz6KfRrM&ab_channel=MarcaClaro',

        ]);

        //$user->perfil()->create();

        $user2 = User::create([
            'name'=> 'pablo',
            'email'=> 'prueba1@gmail.com',
            'password'=> Hash::make('12345678'),
            'url'=> 'https://www.youtube.com/watch?v=i-bPz6KfRrM&ab_channel=MarcaClaro',

        ]);

        //$user2->perfil()->create();

    }
}
