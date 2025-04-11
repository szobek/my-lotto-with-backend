@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center">Create Lotto Ticket</h1>
        {{-- <form action="{{ route('lotto.ticket.store') }}" method="POST"> --}}
        <form action="" method="POST">
            @csrf
            <div id="ticket">
                <h1>Jelölj be számokat</h1>
                <div id="number-wrapper"></div>
            </div>
            <button type="submit" class="btn btn-primary">Mentés</button>
        </form>
     
    </div>

@endsection
@section('title', 'Lotto Ticket Create')
