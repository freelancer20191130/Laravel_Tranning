<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class M0070Controller extends Controller
{
    //
    public function getIndex(Request $request)
    {
        return view('m0070.index');
    }
}
