<?php

use Illuminate\Database\Seeder;
use App\Projeto;

class ProjetoInicial extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Projeto::create([
            'instituicao' => "Instituição do primeiro projeto.",
            'descricao' => "Descrição primeiro projeto.",
        ]);
    }
}
