<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->migration();
    }

    private function migration()
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

    private function migrateCarpeta()
    {
        $r = [];
        $r[] = "database/seeders/sql/linea_106/linea_106_database.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_anuncios.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_como_conocieron.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_departamentos.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_estados_civiles.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_etnias.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_etnicidades.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_generos.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_lineas_intervencion.sql";
        // $r[] = "database/seeders/sql/linea_106/linea_106_table_migrations.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_motivo_consultas.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_motivos.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_municipios.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_niveles_educacion.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_oauth_clients.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_oauth_personal_access_clients.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_ocupaciones.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_orientaciones_sexuales.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_origenes.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_poblaciones_interes.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_quienes_comunican.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_radicados.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_relaciones.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_remisiones.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_respuestas.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_sexos.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_tipo_casos.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_tipo_caso_especificos.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_tipo_pacientes.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_tipos_identificacion.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_turnos.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_veredas.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_zonas.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_users.sql";
        $r[] = "database/seeders/sql/linea_106/linea_106_table_pacientes.sql";
        // $r[] = "database/seeders/sql/linea_106/linea_106_table_casos.sql";

        foreach ($r as $path) {
            echo $path;
            DB::unprepared(file_get_contents($path));
        }
    }
}
