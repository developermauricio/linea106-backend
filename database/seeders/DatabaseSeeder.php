<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/seeders/sql/departamentos.sql';
        DB::unprepared(file_get_contents($path));
        $path = 'database/seeders/sql/municipios.sql';
        DB::unprepared(file_get_contents($path));
        $path = 'database/seeders/sql/veredas.sql';
        DB::unprepared(file_get_contents($path));

        \App\Models\User::factory(1)->create([
            'email' => "admin@example.com",
            'rol' => User::ADMINISTRADOR
        ]);
        \App\Models\User::factory(1)->create([
            'email' => "ps@example.com",
            'rol' => User::PSICOLOGO
        ]);


        Artisan::call('passport:install --force');
    }
}
