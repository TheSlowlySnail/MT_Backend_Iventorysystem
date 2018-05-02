<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class uploadController extends Controller
{
    public function store(request $request){
        //
        $image = $request->file('image');
        $destinationPath = public_path('/images');
        $image->move($destinationPath);
        //return $request->file('image')->move(public_path('images'));

    }
}
