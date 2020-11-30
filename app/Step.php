<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Task;

class Step extends Model
{
    protected $fillable = [
        'name', 'completion', 'task_id'
    ];

    protected $attributes = [
        'completion' => 0
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
