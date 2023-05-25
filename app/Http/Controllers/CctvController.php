<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CctvController extends Controller
{
    public function show()
    {
        return view('pages.user-profile');
    }
}
