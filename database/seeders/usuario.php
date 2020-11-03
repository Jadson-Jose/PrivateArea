<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class usuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = new \App\Models\Usuario;
        $usuario->usuario = 'user@gmail.com';
        $usuario->senha = Hash::make('abc123');
        $usuario->save();
    }
}
