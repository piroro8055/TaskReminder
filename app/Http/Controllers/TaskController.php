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
 
    public function edit(Task $task)
    {
        return view('tasks.edit',compact('task'));

    }

    public function update(Request $request,Task $task)
    {
        $request->validate([
           'title'=>'required|max:225',
           'description'=>'nullable',
           'priority'=>'required|in:low,medium,high',
           'due_date'=>'nullable|max:225',
        ]);
        
        $task->update([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'priority'=>$request->input('priority'),
            'due_date'=>$request->input('due_date'),
        ]);
        
        
         return redirect()->route('tasks.index')->with('success','Task Created');

    }
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success','Task Deleted');

    }

    public function complete(Task $task)
    {
        $task->update([
            'completed'=>true,
            'completed_at' =>now(),
        ]);
        return redirect()->route('tasks.index')->with('success','Task completed');

    }

}
