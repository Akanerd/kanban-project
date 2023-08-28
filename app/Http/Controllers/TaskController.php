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

    public function edit($id)
    {
        $pageTitle = 'Edit List';
        $task = Task::findOrFail($id);
        return view('tasks.edit', ['pageTitle' => $pageTitle, 'task' => $task]);
    }
}
