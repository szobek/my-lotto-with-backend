@extends('layouts.app')
@section('title')
Sorsolás 
@endsection
@section('content')
<div class="container">
    <h1 class="text-center">Lotto Ticket List</h1>
    <div class="row">
        <div class="col-md-12">
            <h1>Nyerőszámok: {{$resultOfCheck["wn"]}}</h1>
            <table class="table table-bordered ticket-list-table">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Numbers</th>
                        <th>Draw Date</th>
                        <th>User name</th>
                        <th>User email</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resultOfCheck["tickets"] as $ticket)
                        <tr >
                            <td>{{ $ticket["id"] }}</td>
                            <td>{{  $ticket["numbersInString"] }}</td>
                            <td>{{ $ticket["created"] }}</td>
                            <td>{{ $ticket["name"] }}</td>
                            <td>{{ $ticket["email"] }}</td>
                            <td>{{ $ticket["count"] }}{{($ticket["count"]>0)?" | (".implode(";",$ticket["counted"]).")":""}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection