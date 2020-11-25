<?php

namespace App\Repositories;


class ProjectRepository
{

    public function create($request)
    {
        request()->user()->projects()->create([
            'name' => $request->name,
            'thumbnail' => $this->thum($request)
        ]);
    }


    public function thum($request)
    {
        if ($request->hasFile('thumbnail')) {
            //获取图片
            $thum = $request->thumbnail;

            //获取图片名称
            $name = $thum->hashName();


            $path = $thum->storeAs('public/thums/original', $name);
            // dd($path);

            return $name;
        }
    }
}
