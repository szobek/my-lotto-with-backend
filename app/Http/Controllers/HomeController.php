<?php

namespace App\Http\Controllers;

use App\Models\WinnerNumber;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $winner_numbers = $this->generateNumbers();
        // WinnerNumber::create([
        //     'numbers' => implode(',', $winner_numbers),
        // ]);
        $dash = [];
        $rows = WinnerNumber::all()->pluck('numbers')->toArray();
$date_ = WinnerNumber::orderBy('created_at', 'desc')->first();
$date = Carbon::parse($date_->created_at);
$last_date=$date->format('Y-m-d');
$now = Carbon::now();
$last_week = $now->subDays(7)->format('Y-m-d');

echo ($last_week<$last_date)?"nem kell sorsolni":"folytatni kell";
dd($last_week);
        foreach ($rows as $key => $value) {
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
