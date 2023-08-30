@extends('layouts.master')

@section('pageTitle', $pageTitle)

@section('main')
    <div class="form-container">
        <h1 class="form-title">{{ $pageTitle }}</h1>
        <form action="{{ route('tasks.update', ['id' => $task->id]) }}" method="POST" class="form">
            @method('PUT')
            @csrf
            <div class="form-item">
                <label>Name:</label>
                <input type="text" class="form-input" name="name" value="{{ old('name', $task->name) }}">
            </div>
            @error('name')
                <div class="alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-item">
                <label>Detail:</label>
                <textarea class="form-text-area" name="detail">{{ old('detail', $task->detail) }}</textarea>
            </div>

            <div class="form-item">
                <label>Due Date:</label>
                <input type="date" class="form-input" name="due_date" value="{{ old('status', $task->due_date) }}">
            </div>
            @error('due_date')
                <div class="alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-item">
                <label>Progress:</label>
                <select class="form-input" name="status">
                    <option @if ($task->status == 'not_started') selected @endif value="not_started">Not Started</option>
                    <option @if ($task->status == 'in_progress') selected @endif value="in_progress">In Progress</option>
                    <option @if ($task->status == 'in_review') selected @endif value="in_review">Waiting / In Review</option>
                    <option @if ($task->status == 'completed') selected @endif value="completed">Completed</option>
                </select>
            </div>
            <button type="submit" class="form-button">Submit</button>
        </form>
    </div>
@endsection
