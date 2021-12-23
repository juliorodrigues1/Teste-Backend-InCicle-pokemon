<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class GetwayResquest{

    public function getUri(){
        return Http::get(env('URL_POKEMON'));
    }
}
