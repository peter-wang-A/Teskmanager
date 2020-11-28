<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;
use Illuminate\Support\Carbon;

class Task extends Model
{
    protected $fillable = [
        'name', 'project_id', 'completion'
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // // 属性获取器
    // public function getUpdatedAtAttribute($value)
    // {
    //     return $value->diffForHumans();
    // }
}
