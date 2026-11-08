<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function welcome(): View
    {
        $tasks = Task::query()
            ->whereDate('task_date', today())
            ->orderBy('id')
            ->get();

        return view('welcome', compact('tasks'));
    }

    public function index(): View
    {
        $tasks = Task::query()
            ->orderBy('task_date', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return view('tasks.index', compact('tasks'));
    }
}
