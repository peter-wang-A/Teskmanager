<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;
use Illuminate\Support\Carbon;
use App\Step;

class Task extends Model
{
    protected $fillable = [
        'name', 'project_id', 'completion'
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }
}
