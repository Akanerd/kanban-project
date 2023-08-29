@extends('layouts.master')

@section('pageTitle', $pageTitle)

@section('main')
    <div class="form-container">
        <h1 class="form-title">{{ $pageTitle }}</h1>
        <form class="form" action="{{ route('auth.signup') }}" method="post">
            @csrf
            <div class="form-item">
                <label>Name:</label>
                <input type="text" class="form-input" value="{{ old('name') }}" name="name">
                @error('name')
                    <div class="alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-item">
                <label>Email:</label>
                <input type="email" class="form-input" value="{{ old('email') }}" name="email">
                @error('email')
                    <div class="alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-item">
                <label>Password:</label>
                <input type="password" class="form-input" value="" name="password">
                @error('password')
                    <div class="alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="form-button">Submit</button>
        </form>
    </div>
@endsection
