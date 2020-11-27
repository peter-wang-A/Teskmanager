<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Task extends Model
{
    protected $fillable = [
        'name', 'project_id', 'completion'
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    //属性获取器
    // public function getProjectListAttribute()
    // {
    //     return $this->project->id;
    // }
}
