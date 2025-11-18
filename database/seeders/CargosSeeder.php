<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Seeder;

class CargosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargos = ['Presidente', 'Gerente', 'Coordinador', 'Analista', 'Auxiliar'];

        foreach ($cargos as $c) {
            Cargo::create(['nombre' => $c]);
        }
    }
}
