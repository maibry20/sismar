<?php

use Illuminate\Database\Seeder;

class ParametersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("parameters")->insert([
            'description' => 'activo',
            'code' => 1,
            'value'=>0,
            'group' => "generic",
        ]);
        DB::table("parameters")->insert([
            'description' => 'inactivo',
            'code' => 2,
            'value'=>0,
            'group' => "generic",
        ]);
        DB::table("parameters")->insert([
            'description' => 'Prestamo',
            'code' => 3,
            'value'=>0,
            'group' => "generic",
        ]);
        DB::table("parameters")->insert([
            'description' => 'Bloqueado',
            'code' => 4,
            'value'=>0,
            'group' => "generic",
        ]);
        
        DB::table("parameters")->insert([
            'description' => 'Eliminado',
            'code' => 4,
            'value'=>0,
            'group' => "generic",
        ]);
        
        DB::table("parameters")->insert([
            'description' => 'Averiado',
            'code' => 1,
            'value'=>0,
            'group' => "reason",
        ]);
        
        DB::table("parameters")->insert([
            'description' => 'Reparacion',
            'code' => 2,
            'value'=>0,
            'group' => "reason",
        ]);
        
        DB::table("parameters")->insert([
            'description' => 'Días para devolver elemento',
            'code' => 1,
            'value'=>5,
            'group' => "timeloan",
        ]);
        
        DB::table("parameters")->insert([
            'description' => 'Prestamo',
            'code' => 1,
            'value'=>0,
            'group' => "event",
        ]);
        DB::table("parameters")->insert([
            'description' => 'Devolucion',
            'code' => 2,
            'value'=>0,
            'group' => "event",
        ]);
    }

}
