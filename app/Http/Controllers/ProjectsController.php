<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;



class ProjectsController extends Controller
{

    protected $repo;
    public function __construct(ProjectRepository $repo)
    {

        $this->middleware('auth');
        $this->repo = $repo;
    }

    public function create()
    {
        // shoew add view
    }
    //增
    public function store(CreateProjectRequest $request)
    {
        $this->repo->create($request);
        return back();
    }
    //删
    public function destroy($id)
    {
        $this->repo->delete($id);
        return back();
    }

    //改
    public function edit()
    {
        //show update view
    }
    public function update(UpdateProjectRequest $request, $id)
    {
        $this->repo->update($request, $id);
        return back();
    }

    //查
    public function index()
    {
        $projects =  $this->repo->list();
        return view('welcome', compact('projects'));
    }
    public function show($id)
    {
        $pro = $this->repo->find($id);
        return view('projects.show', compact('pro'));
    }
}
