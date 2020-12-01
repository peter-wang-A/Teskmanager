<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TaskRepository as TaskRep;
use App\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\UpdateTaskRequest;

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
        $steps =  $task->steps;
        // dd($steps);
        return view('tasks.show', compact('task', 'steps'));
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
}
