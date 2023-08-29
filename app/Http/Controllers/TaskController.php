<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $pageTitle = 'Task List';
        $tasks = Task::all();
        return view('tasks.index', ['pageTitle' => $pageTitle, 'tasks' => $tasks]);
    }

    public function create()
    {
        $pageTitle = 'Create Task';
        return view('tasks.create', ['pageTitle' => $pageTitle]);
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
        ]);

        $task->save();

        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $pageTitle = 'Edit List';
        $task = Task::findOrFail($id);
        return view('tasks.edit', ['pageTitle' => $pageTitle, 'task' => $task]);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->update([
            'name'     => $request->name,
            'detail'   => $request->detail,
            'due_date' => $request->due_date,
            'status'   => $request->status,
        ]);

        return redirect()->route('tasks.index');
    }

    public function delete($id)
    {
        $pageTitle = 'Delete Task';
        $task = Task::findOrFail($id);
        return view('tasks.delete', ['pageTitle' => $pageTitle, 'task' => $task]);
    }

    public function destroy($id)
    {
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
        return view('tasks.progress', ['pageTitle' => $title, 'tasks'=> $tasks]);
    }
}
