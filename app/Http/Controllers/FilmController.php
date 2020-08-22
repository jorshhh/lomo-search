<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{

    public function search(Request $request, $term){
        return Film::search($term)->get();
    }

}
