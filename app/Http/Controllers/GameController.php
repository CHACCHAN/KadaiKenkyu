<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    // ナンプレ
    public function showNumberPlate()
    {
        return view('Game.numberplate');
    }
}
