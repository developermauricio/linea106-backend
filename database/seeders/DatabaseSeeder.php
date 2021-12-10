<?php

namespace Database\Seeders;

use App\Models\User;
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
        \App\Models\User::factory(1)->create([
            'email' => "admin@example.com",
            'rol' => User::ADMINISTRADOR
        ]);
        \App\Models\User::factory(1)->create([
            'email' => "ps@example.com",
            'rol' => User::PSICOLOGO
        ]);
    }
}
