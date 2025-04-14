<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LottoController;

Route::get('/ticket/list', [LottoController::class, 'listTickets'])->name('lotto.ticket.list');
Route::get('/ticket/create', [LottoController::class, 'createTicketView'])->name('lotto.ticket.create');
Route::post('/ticket/create', [LottoController::class, 'createTicketStore'])->name('lotto.ticket.store');
Route::get('/drawn', [LottoController::class, 'drawn'])->name('lotto.drawn');
