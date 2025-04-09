@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center">Create Lotto Ticket</h1>
        {{-- <form action="{{ route('lotto.ticket.store') }}" method="POST"> --}}
        <form action="" method="POST">
            @csrf
            <div class="mb-3">
                <label for="numbers" class="form-label">Enter Numbers (comma separated)</label>
                <input type="text" class="form-control" id="numbers" name="numbers" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Ticket</button>
        </form>
        <div class="mt-4">
            <h2>Instructions</h2>
            <p>Please enter your lotto numbers in the format: 1,2,3,4,5,6</p>
            <p>Make sure to separate each number with a comma.</p>
    </div>
@endsection
@section('title', 'Lotto Ticket Create')
