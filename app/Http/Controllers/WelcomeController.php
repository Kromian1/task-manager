<?php

namespace App\Http\Controllers;

use App\Models\{User, Label, Task, TaskStatus};

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'tasksCount' => Task::all()->count(),
            'labelsCount' => Label::all()->count(),
            'statusesCount' => TaskStatus::all()->count(),
            'usersCount' => User::all()->count()
        ]);
    }
}
