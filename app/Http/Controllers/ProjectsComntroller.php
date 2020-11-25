<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;



class ProjectsComntroller extends Controller
{

    protected $repo;
    public function __construct(ProjectRepository $repo)
    {

        $this->middleware('auth');
        $this->repo = $repo;
    }
    //存数据到数据库
    public function store(createProjectRequest $request)
    {
        $this->repo->create($request);
        return back();
    }
}
