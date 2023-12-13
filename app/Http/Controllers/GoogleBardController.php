<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleBardController extends Controller
{
    public function googlebard(Request $request)
    {
        $bard = 1;

        return response()->json([
            'response' => $bard["content"],
        ], 200);
    }
}
