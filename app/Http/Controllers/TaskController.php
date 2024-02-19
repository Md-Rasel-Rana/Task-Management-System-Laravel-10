<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function taskpage(){
     $tasks=   Task::where('completed',false)->orderBy('priority','desc')->orderBy('due_date')->get();
        return view('index',compact('tasks'));
    }
    public function taskscreate(){
        return view('craete');
    }
    public function taskseditpage($id){
        $task = Task::findOrFail($id); // Retrieve the task by ID
        return view('edit', compact('task')); 
    }
   
    public function tasksstore(Request $request){
       Task::create([
        'title'=>$request->input('title'),
        'description'=>$request->input('description'),
        'due_date'=>$request->input('due_date'),
        'priority'=>$request->input('priority'),
       ]);
       return redirect('/task-page')->with('success','Task Created Successfully');
    }
    public function tasksupdate(Request $request ,$id){
       Task::where('id',$id)->update([
        'title'=>$request->input('title'),
        'description'=>$request->input('description'),
        'due_date'=>$request->input('due_date'),
        'priority'=>$request->input('priority'),
       ]);
       return redirect('/task-page')->with('success','Task Update Successfully');
    }

    public function tasksdelete($id){
       Task::findOrFail($id)->delete();
       return redirect('/task-page')->with('success','Task Delete Successfully');
    }
    public function taskscomplete($id){
        Task::where('id',$id)->update([
            'completed'=>true,
            'completed_at'=>now(),
        ]);
        return redirect('/task-page')->with('success','Task Complete Successfully');
    }

    public function taskshow(){
        $completedTasks= Task::where('completed',true)->get();
        return view('taskshow',compact('completedTasks'));
    }

}
