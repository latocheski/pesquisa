<?php

use Illuminate\Database\Seeder;
use App\Area;

class AreasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = array(
            "Planejamento",
            "Colaboração",
            "Produção",
            "Licenciamento",
            "Avaliação",
        );

        foreach ($areas as $area) {
            Area::create([
                'area' => $area,
            ]);
        }
    }
}
