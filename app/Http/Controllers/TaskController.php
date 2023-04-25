<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('priority', 'ASC')->get();
        return view('Tasks.list-task', [
            'tasks' => $tasks
        ]);
    }

    public function new()
    {
        return view('Tasks.new-task');
    }

    public function updatePosition(Request $request)
    {
        $tasks = Task::all();

        foreach ($tasks as $task) {
            foreach ($request->order as $order) {
                if ($order['id'] == $task->id) {
                    $task->update(['priority' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->name);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tasks|max:255',

        ]);

        if ($validator->fails()) {
            dd("Failed");
        }

        $latest_task = Task::latest()->first();

        if (isset($latest_task)) {
            Task::create([
                'name' => $request->name,
                'priority' => $latest_task->priority + 1,
            ]);
        } else {

            Task::create([
                'name' => $request->name,
                'priority' => 1,
            ]);
        }
        return redirect()->route('task.index')->with('message', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findorfail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findorfail($id);
        return view('Tasks.edit-task', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTask(Request $request, $id)
    {
        //dd("test");
        $task = Task::findorfail($id);
        if ($request->name) {
            $task->name = $request->name;
            $task->save();
        }
        return redirect()->route('task.index')
            ->with('message', 'Task Updated');
    }

    public function update(Request $request, $id)
    {
        dd("test");
        $task = Task::findorfail($id);
        if ($request->name) {
            $task->name = $request->name;
            $task->save();
        }
        return redirect()->route('task.index')
            ->with('message', 'Task Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $task = Task::findorfail($id);
        $task->delete();
        return redirect()->route('task.index')
            ->with('message', 'Task Deleted');
    }

    public function destroy($id)
    {
        $task = Task::findorfail($id);
        $task->delete();
        return "success";
    }
}
