@extends('layouts.app')
@section('content')

    @if ($errors->any())
        <div id="error-alert" class="alert alert-danger alert-dismissible fade show">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
        
    @endif

    <div class="container">
        <form action="{{ route('lotto.ticket.create') }}" method="POST" id="ticket-form" >
            @csrf
            <div id="ticket">
                <h1>Jelölj be számokat</h1>
                <div id="number-wrapper"></div>
                <input type="hidden" name="numbers" id="numbers" value="">
            </div>
        </form>
        <button id="random-numbers" class="btn btn-secondary">Véletlen számok</button>
        <hr>
        <button  class="btn btn-primary" id="save-ticket" >Mentés</button>
    </div>
    
@endsection
@section('title', 'Lotto Ticket Create')
