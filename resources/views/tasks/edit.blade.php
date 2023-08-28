@extends('layouts.master')

@section('pageTitle', $pageTitle)

@section('main')
    <div class="form-container">
        <h1 class="form-title">{{ $pageTitle }}</h1>
        <form action="#" class="form">
            <div class="form-item">
                <label>Name:</label>
                <input type="text" class="form-input" value="{{ $task->name }}">
            </div>

            <div class="form-item">
                <label>Detail:</label>
                <textarea class="form-text-area">{{ $task->detail }}</textarea>
            </div>

            <div class="form-item">
                <label>Due Date:</label>
                <input type="date" class="form-input" value="{{ $task->due_date }}">
            </div>

            <div class="form-item">
                <label>Progress:</label>
                <select class="form-input">
                    <option @if ($task->status == 'not_started') @endif value="not_started">Not Started</option>
                    <option @if ($task->status == 'in_progress') @endif value="in_progress">In Progress</option>
                    <option @if ($task->status == 'in_review') @endif value="in_review">Waiting / In Review</option>
                    <option @if ($task->status == 'completed') @endif value="completed">Completed</option>
                </select>
            </div>
            <button type="button" class="form-button">Submit</button>
        </form>
    </div>
@endsection