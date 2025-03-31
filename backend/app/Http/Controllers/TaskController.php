<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class TaskController extends Controller
{
    function index()
    {
        // $data = DB::table('tasks')->get();
        $data = DB::table('tasks')->orderByRaw("CASE 
                            WHEN priority = 'High' THEN 1
                            WHEN priority = 'Medium' THEN 2
                            WHEN priority = 'Low' THEN 3
                        END")->get();

        // dd($data);
        return view('home', ['data' => $data]);
    }
    
    function getdata(Request $request)
    {
        $data = DB::table('tasks')->orderByRaw("CASE 
                            WHEN priority = 'High' THEN 1
                            WHEN priority = 'Medium' THEN 2
                            WHEN priority = 'Low' THEN 3
                        END")->get();
        return response()->json($data, 200);
    }

    function new()
    {
        return view('new');
    }

    function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required|in:Low,Medium,High'

        ]);
        $data = new Task();
        $data -> title = $request->title;
        $data -> description = $request->description;
        $data -> priority = $request->priority;
        $data->save();
        return redirect('/');
    }

    function edit(string $id)
    {
        
        $data = Task::findOrFail($id);
        return view('edit', ['data'=>$data]);
    }

    function update(Request $request, string $id)
    {
        // dd($request);
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'status' => 'required',
        ]);
        $data = Task::findOrFail($id);
        $data -> title = $request->title;
        $data -> description = $request->description;
        $data -> priority = $request->priority;
        $data -> status = $request->status;
        $data->save();
        return redirect('/');
    }

    function delete(string $id)
    {
        Task::findOrFail($id)->delete();
        return redirect('/');
    }
}
