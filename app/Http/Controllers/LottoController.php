<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Ticket;
use App\Models\WinnerNumber;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LottoController extends Controller
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
        $last_date = $date->format('Y-m-d');
        $now = Carbon::now();
        $last_week = $now->subDays(7)->format('Y-m-d');

        echo ($last_week < $last_date) ? "nem kell sorsolni" : "folytatni kell";
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

        return view('lotto.index', compact('winner_numbers', 'dash'));
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

    public function listTickets()
    {
        $user = Auth::user();
        $tickets = Ticket::where('user_id', $user->id)->get();
        return view('lotto.ticket-list', compact('tickets'));
    }

    public function createTicketView()
    {
        return view('lotto.ticket-create');
    }
    public function createTicketStore(Request $request)
    {
        $numbers = $request->input('numbers');
        $user = Auth::user();
        $request->validate([
            'numbers' => 'required|string',
        ]);
        $numbersInRequest = explode(',', $numbers);
        $errors = [];
        foreach ($numbersInRequest as $number) {
            if (!is_numeric($number) || $number < 1 || $number > 90) {
                $errors['numbers'] = 'A számoknak 1 és 90 között kell lenniük!';
            }
        }
        if (count($numbersInRequest) != 5) {
            $errors['numbersLength'] = 'A számoknak 5-nek kell lennie!';
        }
        if (count($errors) > 0) {
            return redirect()->back()->withErrors($errors);
        }
        $balance = $user->balance->balance;
        if ($balance > 100) {

            $ticket = new Ticket();
            $ticket->user_id = $user->id;
            $ticket->numbers = $numbers;
            $ticket->save();
            $data = [];
            $ticketPrice = env("TICKET_PRICE", 200);
            $data["balance"] = $balance - $ticketPrice;
            Balance::where('user_id', $user->id)->update($data);
        }
        return redirect('/lotto/ticket/list');
    }

    private function getWinnerNumbers()
    {
        $winner_numbers_ = $this->generateNumbers();
        $winner_numbers = implode(',', $winner_numbers_);
        WinnerNumber::create([
            'numbers' => $winner_numbers,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return $winner_numbers_;
    }

    public function drawn()
    {
        $resultOfCheck = $this->checkNumbers();
        // dd($resultOfCheck);
        return view('lotto.drawn', compact('resultOfCheck'));
    }

    private function getTicketsFromDB()
    {
        return Ticket::where('status', 'active')->get();
    }
    private function checkNumbers()
    {
        $winner_numbers = $this->getWinnerNumbers();
        $win_amount = env("WIN_AMOUNT", 200);

        // lekéri az aktív jegyket
        $tickets = $this->getTicketsFromDB();
        $resultOfCheck = ["tickets" => []];
        foreach ($tickets as $t) {
            $dataOfTicket = [
                'status' => $t->status,
                'id' => $t->id,
                'numbers' => explode(',', $t->numbers),
                'numbersInString' => $t->numbers,
                'user_id' => $t->user_id,
                'name' => $t->user->name,
                'email' => $t->user->email,
                'created' => $t->created_at,
                'count' => 0,
                'counted' => [],
                'winAmount' => 0,
                'status' => $t->status
            ];
            foreach ($winner_numbers as $num) {

                if (in_array($num, $dataOfTicket['numbers'])) {
                    $dataOfTicket['count']++;
                    array_push($dataOfTicket['counted'],$num);
                    $dataOfTicket['winAmount'] = $dataOfTicket['winAmount'] + $win_amount;
                }
            }
            array_push($resultOfCheck["tickets"], $dataOfTicket);
        }
        $resultOfCheck['wn'] = implode(',', $winner_numbers);
        $this->setUserBalance($resultOfCheck);
        $this->setTicketToInactive();
        return $resultOfCheck;
    }

    private function setTicketToInactive()
    {
        // UPDATE `tickets` SET `status`='active';
        Ticket::query()->update(['status' => 'inactive']);
    }

    private function setUserBalance(array $data)
    {

        foreach ($data["tickets"] as $ticket) {
            if (count($ticket) > 0) {
                $user = User::find($ticket['user_id']);
                $balance = $user->balance->balance;
                $data = [];
                $data["balance"] = $balance + $ticket['winAmount'];
                Balance::where('user_id', $user->id)->update($data);
            }
        }
    }
}
