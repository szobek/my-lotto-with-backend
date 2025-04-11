@extends('layouts.app')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <h1 class="text-center">Create Lotto Ticket</h1>
        {{-- <form action="{{ route('lotto.ticket.store') }}" method="POST"> --}}
        <form action="{{ route('lotto.ticket.create') }}" method="POST">
            @csrf
            <div id="ticket">
                <h1>Jelölj be számokat</h1>
                <div id="number-wrapper"></div>
                <input type="hidden" name="numbers" id="numbers" value="">
            </div>
            <button type="submit" class="btn btn-primary" id="save-ticket" disabled>Mentés</button>
        </form>

    </div>

@endsection
@section('title', 'Lotto Ticket Create')
