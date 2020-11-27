<?php

namespace App\Repositories;

use App\Handlers\ImageUploadHandler as Image;
use App\Project;

class ProjectRepository
{
    protected $img;
    public function __construct(Image $image)
    {
        $this->img = $image;
    }

    //显示当前项目数据
    public function show($id)
    {
        dd($this->find($id));
    }
    //添加 project 数据
    public function create($request)
    {
        request()->user()->projects()->create([
            'name' => $request->name,
            'thumbnail' => $this->thum($request)
        ]);
    }

    //列出用户所有的项目
    public function list()
    {
        return  request()->user()->projects()->get();
    }
    //查找项目
    public function find($id)
    {
        return Project::find($id);
    }
    //删除项目
    public function delete($id)
    {
        $this->find($id)->delete();
    }

    //编辑项目
    public function update($request, $id)
    {

        $project = $this->find($id);
        // dd($request->hasFile('thumbnail'));
        $project->name = $request->name;
        if ($request->hasFile('thumbnail')) {
            $project->thumbnail = $this->thum($request);
        }
        $project->save();
    }

    //未完成项目
    public function todos($project)
    {
        return $todos = $project->tasks()->where('completion', (int) false)->get();
    }
    //已完成项目
    public function dones($project)
    {
        return $dones = $project->tasks()->where('completion', (int) true)->get();
    }

    //修改图片从尺寸,封装函数
    public function thum($request)
    {
        $path = null;
        if ($request->hasFile('thumbnail')) {
            $result = $this->img->save($request->thumbnail, 'thumbs', request()->user()->id, 200, 100);
            if ($result) {
                $path = $result['path'];
            }
        }
        return $path;
    }
}
