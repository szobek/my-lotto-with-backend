<?php

namespace App\Http\Controllers;

use App\Models\WinnerNumber;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $string = WinnerNumber::first()->numbers;
        $array = $this->generateNumber();
        return view('welcome', compact('array'));
    }

    private function generateNumber ()
    {
        $numbers = [];
        while (count($numbers) < 6) {
            $number = rand(1, 60);
            if (!in_array($number, $numbers)) {
                $numbers[] = $number;
            }
        }

        sort($numbers);
        return $numbers;
    }
         
}
