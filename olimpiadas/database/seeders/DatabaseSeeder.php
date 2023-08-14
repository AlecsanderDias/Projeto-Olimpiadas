<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Modalidade;
use App\Models\Tipo;
use App\Models\Especialidade;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Modalidade::create(['nome' => 'Futsal']);
        Modalidade::create(['nome' => 'Voleibol']);
        Modalidade::create(['nome' => 'Queimada']);
        Modalidade::create(['nome' => 'Basquete']);
        Modalidade::create(['nome' => 'Sinuca']);
        Modalidade::create(['nome' => 'Tênis de Mesa']);
        Modalidade::create(['nome' => 'Pebolim']);
        Modalidade::create(['nome' => 'Truco']);
        Modalidade::create(['nome' => 'Dominó']);
        Tipo::create(['nome' => 'Rodízio Simples']);
        Tipo::create(['nome' => 'Rodízio Duplo']);
        Tipo::create(['nome' => 'Rodízio Simples + Eliminatória Simples']);
        Tipo::create(['nome' => 'Rodízio Duplo + Eliminatória Simples']);
        Tipo::create(['nome' => 'Eliminatória Simples']);
        Especialidade::create(['nome' => 'Masculino']);
        Especialidade::create(['nome' => 'Feminino']);
        Especialidade::create(['nome' => 'Misto']);
        Especialidade::create(['nome' => 'Individual']);
        Especialidade::create(['nome' => 'Dupla']);
    }
}
