<?php

namespace App\Http\Controllers;

use App\Models\WinnerNumber;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $winner_numbers = $this->generateNumbers();
        WinnerNumber::create([
            'numbers' => implode(',', $winner_numbers),
        ]);
        $dash = [];
        $string = WinnerNumber::all()->pluck('numbers')->toArray();
        foreach ($string as $key => $value) {
            $nums = explode(',', $value);
            foreach ($nums as $num) {
                if (isset($dash[$num])) {
                    $dash[$num]++;
                } else {
                    $dash[$num] = 1;
                }
            }
        }

        return view('welcome', compact('winner_numbers','dash'));
    }

    private function generateNumbers()
    {
        $numbers = [];
        while (count($numbers) < 5) {
            $number = rand(1, 90);
            if (!in_array($number, $numbers)) {
                $numbers[] = $number;
            }
        }
        sort($numbers);
        return $numbers;
    }
}
