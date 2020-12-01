<?php

namespace App\Http\Controllers;

use App\Step;
use Illuminate\Http\Request;
use App\Task;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        return response()->json([
            'steps' => $task->steps,
        ]);
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
    public function store(Task $task, Request $request)
    {
        $task->steps()->create(['name' => $request->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function show(Step $step)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function edit(Step $step)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task, Step $step)
    {
        $step->update([
            'completion' => $request->completion
        ]);
        return response()->json([
            'code' => 200,
            'msg' => '修改成功'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task, Step $step)
    {
        $step->delete();
        return response()->json([
            'code' => 200,
            'msg' => '删除成功'
        ]);
    }

    public function doneAll(Task $task)
    {
        $task->steps()->update([
            'completion' => 1
        ]);
        return response()->json([
            'code' => 200,
            'msg' => '修改成功'
        ]);
    }

    public function clearAll(Task $task)
    {
        $task->steps()->where('completion', 1)->delete();
        return response()->json([
            'code' => 200,
            'msg' => '删除成功'
        ]);
    }
}
