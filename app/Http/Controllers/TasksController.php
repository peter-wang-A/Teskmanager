<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TaskRepository as TaskRep;
use App\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\UpdateTaskRequest;
use App\Project;

class TasksController extends Controller
{
    protected $task;
    public function __construct(TaskRep $task)
    {
        // dd($task);
        $this->task = $task;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return response()->json([
            'tasks' => $this->task->all(),
        ], 200);
    }
    public function index()
    {
        // 查出当前用户项目 ID
        $todos = $this->task->todos();
        $dones = $this->task->dones();
        $projects = request()->user()->projects->pluck('name', 'id');
        // dd($projects);
        return view('tasks.index', compact('todos', 'dones', 'projects'));
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
    public function store(CreateTask $request)
    {
        $this->task->create($request);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
    }

    public function check($id)
    {
        $this->task->check($id);
        return back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $this->task->update($request, $id);
        // dd($id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->task->delete($id);
        return back();
    }

    public function charts()
    {
        $todo =  $this->task->todoCount();
        $done =  $this->task->doneCount();
        $total = request()->user()->tasks()->count();
        $names = Project::pluck('name')->toArray();
        json_encode($names);
        $names = json_encode($names);
        $projects = request()->user()->projects;

        return view('tasks.charts', compact('total', 'todo', 'done', 'names', 'projects'));
    }
}
