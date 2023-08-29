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
                    <option @if ($status == 'not_started') selected @endif value="not_started">Not Started</option>
                    <option @if ($status == 'in_progress') selected @endif value="in_progress">In Progress</option>
                    <option @if ($status == 'in_review') selected @endif value="in_review">In Review</option>
                    <option @if ($status == 'completed') selected @endif value="completed">Completed</option>
                </select>
            </div>
            @error('status')
                <div class="alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="form-button">Submit</button>
        </form>
    </div>
@endsection
