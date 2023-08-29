<div class="task-progress-column">
    <div class="task-progress-column-heading">
        <h2>{{ $title }}</h2>
        @php
            use App\Models\Task;
        @endphp
        @if ($title == 'Not Started')
            <a href="{{ route('tasks.create', ['status' => Task::STATUS_NOT_STARTED]) }}"><span
                    style="color: black" class="material-icons outlined">add</span></a>
        @elseif ($title == 'In Progress')
            <a href="{{ route('tasks.create', ['status' => Task::STATUS_IN_PROGRESS]) }}"><span
                    style="color: black" class="material-icons outlined">add</span></a>
        @elseif ($title == 'In Review')
            <a href="{{ route('tasks.create', ['status' => Task::STATUS_IN_REVIEW]) }}"><span style="color: black"
                    class="material-icons outlined">add</span></a>
        @elseif ($title == 'Completed')
            <a href="{{ route('tasks.create', ['status' => Task::STATUS_COMPLETED]) }}"><span
                    style="color: black" class="material-icons outlined">add</span></a>
        @endif
    </div>
    <div>
        @foreach ($tasks as $task)
            @include('partials.task_card', [
                'task' => $task,
                'leftStatus' => $leftStatus,
                'rightStatus' => $rightStatus,
            ])
        @endforeach
    </div>
</div>
