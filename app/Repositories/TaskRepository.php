<?php

namespace App\Repositories;

use App\Task;

class TaskRepository
{
    public function create($request)
    {
        Task::create([
            'name' => $request->name,
            'project_id' => $request->project_id,
            'completion' => (int) false
        ]);
    }
    public function check($id)
    {
        $task = $this->find($id);
        $task->completion = (int) true;
        $task->save();
    }
    public function all()
    {
        return request()->user()->tasks;
    }
    //查找项目
    public function find($id)
    {
        return Task::findOrFail($id);
    }

    public function todos()
    {
        return request()->user()->tasks()->orderBy('id', 'desc')->where('completion', 0)->paginate(10);
    }
    public function dones()
    {
        return request()->user()->tasks()->orderBy('id', 'desc')->where('completion', 1)->paginate(10);
    }

    public function todoCount()
    {
        return request()->user()->tasks()->where('completion', 0)->count();
    }
    public function doneCount()
    {
        return request()->user()->tasks()->where('completion', 1)->count();
    }

    //编辑项目
    public function update($request, $id)
    {

        $task = $this->find($id);
        $task->name = $request->name;
        $task->project_id = $request->project_id;
        $task->save();
    }

    //删除项目
    public function delete($id)
    {
        $this->find($id)->delete();
    }
}
