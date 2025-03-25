<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('completed',false)->orderBy('priority','desc')->orderBy('due_date')->get();
        return view('tasks.index',compact('tasks'));

    }
 
    public function create()
    {
        return view('tasks.create');

    }

    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required|max:225',
           'description' => 'nullable',
           'priority' => 'required|max:225',
           'due_date' => 'nullable|max:225',
        ]);
        
        Task::create([
            'title' => 'required|max:225',
            'description' => 'nullable',
            'priority' => 'required|max:225',
            'due_date' => 'nullable|max:225',
        ]);
        
        
         return view('tasks.create');

    }


}
