<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;

class CameraController extends Controller
{

    public function search(Request $request, $term){
        return Camera::search($term)->get();
    }

}
