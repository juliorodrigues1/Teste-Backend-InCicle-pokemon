<?php

namespace Database\Seeders;

use App\Models\Pokemon;
use App\Services\GetwayResquest;
use Illuminate\Database\Seeder;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getway = new GetwayResquest();
        $response = $getway->getUri();
        foreach ($response->json()['results'] as $pokemon){
            Pokemon::create([
                'nome' => $pokemon['name']
            ]);
        }
    }
}
