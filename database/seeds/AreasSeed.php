<?php

use App\Area;
use Illuminate\Database\Seeder;

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
            "PLAN" => "Planejamento",
            "COL" => "Colaboração",
            "PROD" => "Produção",
            "LIC" => "Licenciamento",
            "AVAL" => "Avaliação",
        );

        foreach ($areas as $key => $area) {
            Area::create([
                'prefixo' => $key,
                'area' => $area,
            ]);
        }
    }
}
