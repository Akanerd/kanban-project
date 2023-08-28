@extends('layouts.master')

@section('pageTitle', $pageTitle)

@section('main')
    <div class="form-container">
        <h1 class="form-title">{{ $pageTitle }}</h1>
        <form action="{{ route('tasks.store') }}" method="POST" class="form">
            @csrf
            <div class="form-item">
                <label>Name:</label>
                <input type="text" class="form-input" value="{{ old('name') }}" name="name">
            </div>
            @error('name')
                <div class="alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-item">
                <label>Detail:</label>
                <textarea class="form-text-area" name="detail">{{ old('detail') }}</textarea>
            </div>

            <div class="form-item">
                <label>Due Date:</label>
                <input type="date" class="form-input" value="{{ old('due_date') }}" name="due_date">
            </div>
            @error('due_date')
                <div class="alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-item">
                <label>Progress:</label>
                <select class="form-input" name="status">
                    <option value="not_started">Not Started</option>
                    <option value="in_progress">In Progress</option>
                    <option value="in_review">Waiting / In Review</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            @error('status')
                <div class="alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="form-button">Submit</button>
        </form>
    </div>
@endsection
