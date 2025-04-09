@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-center">Lotto Ticket List</h1>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Numbers</th>
                        <th>Draw Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{  $ticket->numbers }}</td>
                            <td>{{ $ticket->created_at }}</td>
                            <td>{{ $ticket->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('title', 'Lotto Ticket List')