<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{

    public function __construct()
    {
        // $this->authorizeResource(Task::class);
    }

    public function index()
    {
        $pageTitle = 'Task List';
        $tasks = Task::all();
        return view('tasks.index', ['pageTitle' => $pageTitle, 'tasks' => $tasks]);
    }

    public function create(Request $request)
    {
        $pageTitle = 'Create Task';
        $status = $request->status;

        return view('tasks.create', ['pageTitle' => $pageTitle, 'status' => $status]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'     => 'required',
                'due_date' => 'required',
                'status'   => 'required',
            ],
            $request->all()
        );
        $task = new Task([
            'name'     => $request->name,
            'detail'   => $request->detail,
            'due_date' => $request->due_date,
            'status'   => $request->status,
            'user_id'  => Auth::user()->id,
        ]);

        $task->save();

        return redirect()->route('tasks.index');
    }

    public function edit($id, Task $task)
    {
        $pageTitle = 'Edit List';
        Gate::authorize('update', $task);
        // $this->authorize('update', $task);
        $task = Task::findOrFail($id);
        return view('tasks.edit', ['pageTitle' => $pageTitle, 'task' => $task]);
    }

    public function update(Request $request, $id,Task $task)
    {
        Gate::authorize('update', $task);
        $task = Task::find($id);
        $task->update([
            'name'     => $request->name,
            'detail'   => $request->detail,
            'due_date' => $request->due_date,
            'status'   => $request->status,
        ]);

        return redirect()->route('tasks.index');
    }

    public function delete($id, Task $task)
    {
        $pageTitle = 'Delete Task';
        Gate::authorize('delete', $task);
        $task = Task::findOrFail($id);
        return view('tasks.delete', ['pageTitle' => $pageTitle, 'task' => $task]);
    }

    public function destroy($id, Task $task)
    {
        Gate::authorize('delete', $task);
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function progress()
    {
        $title = 'Task Progress';

        $tasks = Task::all();

        $filteredTasks = $tasks->groupBy('status');

        $tasks = [
            'not_started' => $filteredTasks->get((Task::STATUS_NOT_STARTED), []),
            'in_progress' => $filteredTasks->get((Task::STATUS_IN_PROGRESS), []),
            'in_review'   => $filteredTasks->get((Task::STATUS_IN_REVIEW), []),
            'completed'   => $filteredTasks->get((Task::STATUS_COMPLETED), []),
        ];
        // echo $filteredTasks;
        return view('tasks.progress', ['pageTitle' => $title, 'tasks' => $tasks]);
    }

    public function move(int $id, Request $request, Task $task)
    {
        Gate::authorize('update', $task);
        $task = Task::findOrFail($id);

        $task->update([
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.progress');
    }

    public function completed(int $id, Request $request, Task $task)
    {
        Gate::authorize('update', $task);
        $task = Task::findOrFail($id);

        $task->update([
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index');
    }

    public function home()
    {
        $tasks = Task::where('user_id', auth()->id())->get();

        $completed_count = $tasks->where('status', Task::STATUS_COMPLETED)->count();
        $uncompleted_count = $tasks->whereNotIn('status', Task::STATUS_COMPLETED)->count();

        return view('home', [
            'completed_count'   => $completed_count,
            'uncompleted_count' => $uncompleted_count,
        ]);
    }
}
