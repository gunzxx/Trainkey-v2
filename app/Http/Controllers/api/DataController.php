<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Word;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function data()
    {
        $katas = Word::inRandomOrder()->take(300)->get('kata');
        $katas = array_map(function($kata){
            return $kata['kata'];
        }, $katas->toArray());
        
        if(count($katas) > 10){
            return response()->json($katas);
        }
        return  response()->json([
            'message' => 'empty data'
        ], 400);
    }
}
