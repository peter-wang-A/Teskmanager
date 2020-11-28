<?php

namespace App\Http\ViewComposer;

use Illuminate\Contracts\View\View;
use App\Repositories\TaskRepository as Task;
use Illuminate\Support\Facades\Auth;

class TaskCountComposer
{
    protected $repo;
    public function __construct(Task $task)
    {
        $this->repo = $task;
    }

    public function compose(View $view)
    {
        if (Auth::check()) {
            $view->with([
                'total' => $this->repo->todoCount() + $this->repo->doneCount(),
                'doneCount' => $this->repo->doneCount(),
                'todoCount' =>  $this->repo->todoCount(),
            ]);
        }
    }
}
