<?php

use App\Questoes;
use Illuminate\Database\Seeder;

class QuestoesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *            
     * @return void
     */
    public function run()
    {
        $questoes = array(
            1 => array(
                "No processo de design foram identificadas questões culturais para subsidiar a criação ou adaptação do REA?",
                "Foram identificados os potenciais e os limites de se representar uma determinada questão cultural?",
                "Foram estabelecidos planos para representar as questões culturais identificadas?",                
            ),
            2 => array(
                "Houve a participação de representantes dos futuros usuários do REA durante o design?",
                "Foi criado um ambiente que possibilitou o engajamento das partes no design no REA?",
                "Todos os envolvidos durante o design do REA tiveram suas opiniões ouvidas?",
                "As opiniões e as ideias dos participantes foram respeitadas, principalmente aquelas relacionadas às questões culturais dos usuários?",
                "Foram propostas atividades durante o design que permitiram a colaboração entre os participantes?",
                "Foi criada alguma comunidade online para o design do REA?",
            ),
            3 => array(
                "Foram utilizados softwares livres no design do REA?",
                "Foram feitas buscas por REAs existentes antes de criar o novo?",
                "Elaborou-se guias ou estratégias para adaptação do REA?",
                "Princípios de usabilidade e acessibilidade foram seguidos?",
                "As questões culturais identificadas na área-chave Planejamento foram consideradas na produção?",
                "O REA e seus artefatos foram disponibilizados em formatos abertos?",
                "Foram obedecidos os termos para a produção do novo REA?",
                "O REA foi disponibilizado em repositórios abertos?",
            ),
            4 => array(
                "Foi adotada uma licença flexível?",
                "Os termos de licenciamentos estão claros?",
                "Os créditos ao(s) criador(es) do REA ou artefatos utilizados para a produção do novo REA foram feitos?",
            ),
            5 => array(
                "Como avalia, de forma geral, a representação das questões culturais levantadas na fase de Planejamento?",
                "Como avalia os elementos pedagógicos do REA após a representação das questões culturais?",
                "Como avalia os elementos tecnológicos (interfaces, padrões, desempenho) do REA após a representação das questões culturais?",
                "Como avalia os conteúdos do REA após a representação das questões culturais?",
                "Como avalia o licenciamento do novo REA?",
            ),
        );

        

        foreach ($questoes as $idarea => $chave) {
            foreach ($chave as $prefixo => $pergunta) {
                Questoes::create([
                    'questao' => $pergunta,
                    'idArea' => $idarea,
                ]);
            }
            
        }
    }
}
