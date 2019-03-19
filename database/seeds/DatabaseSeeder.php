<?php

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
        $this->call(EstadosSeeds::class);
        $this->call(AreasSeed::class);
        $this->call(ProjetoInicial::class);
        $this->call(QuestoesSeed::class);
    }
}
