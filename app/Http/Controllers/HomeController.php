<?php

namespace App\Http\Controllers;

use App\Models\WinnerNumber;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $string = WinnerNumber::first()->numbers;
        $array = explode(",", $string);
        return view('welcome', compact('array'));
    }
}
