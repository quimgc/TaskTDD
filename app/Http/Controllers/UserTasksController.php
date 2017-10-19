<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;

class UserTasksController extends Controller
{
    public function index(User $user)
    {
//        $user = User::findOrFail($id);
//        $tasks = Task::all();

        $tasks = Task::where('user_id',$user->id)->get();

        return view('user_tasks', ['tasks' => $tasks, 'user' => $user]);
    }
}
