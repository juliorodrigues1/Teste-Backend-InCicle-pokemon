<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function search(Request $request)
    {
        $pokemonIsFound = $this->binarySearch($request->query('name'), $this->index());
        if ($pokemonIsFound){
            return response()->json(true , 200);
        }else{
            return response()->json(false, 404);
        }
    }

    private function binarySearch($name, $pokemons){
        $middle = intdiv(count($pokemons), 2);

        if($name == $pokemons[$middle]['name']) return true;
        if(count($pokemons) == 1) return false;

        if($name < $pokemons[$middle]['name']) return $this->binarySearch($name, array_slice($pokemons, 0, $middle));
        return $this->binarySearch($name, array_slice($pokemons, $middle));
    }

    private function index()
    {
        $pokemonsDB = Pokemon::orderBy('name')->get();
        $pokemon = [];
        foreach ($pokemonsDB as $key => $pokemonDB){
            $pokemon[$key]['name'] = $pokemonDB->nome;
        }

        return $pokemon;
    }
}
