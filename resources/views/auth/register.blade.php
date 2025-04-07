@extends('layouts.app')

@section('content')
    <div class="register-container">
        <h1 class="text-center">Register</h1>
        <div class="register-form-wrapper">

            <form method="POST" action="{{ route('register') }}" class="register-form">
                {{-- Include CSRF token for security --}}
                @csrf
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="input-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                </div>
                <button type="submit" class="base-btn">Register</button>
            </form>
        </div>
    </div>
@endsection
