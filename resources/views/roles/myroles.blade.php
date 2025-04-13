@extends('layouts.app')
@section('title')
    Jogaim
@endsection

@section('content')
    @foreach ($roles as $role)
        {{ $role->role->name }}
    @endforeach
@endsection
