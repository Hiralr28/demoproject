<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function dummy()
    {
        return response()->json(['message' => 'This is a dummy API response.']);
    }

}
