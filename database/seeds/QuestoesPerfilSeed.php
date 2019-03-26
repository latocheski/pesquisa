<?php

use Illuminate\Database\Seeder;
use App\QuestoesPerfil;

class QuestoesPerfilSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questoes = array(
            1 => "Experiencia sobre o tema:",
            2 => "Experiencia sobre o REA:",
            3 => "Experiencia em ensino:",
            4 => "Conhecimento sobre o tema:",
            5 => "Prática sobre o tema:",
            6 => "Nível de formação:",
            7 => "Experiencia em projetos de REA:",
        );

        $id = 1;

        foreach ($questoes as $pergunta) {

            QuestoesPerfil::create([
                'questao' => $pergunta,
            ]);
        }

    }
}
