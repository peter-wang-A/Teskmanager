<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;
use App\Task;

class Project extends Model
{
    protected $fillable = [
        'name', 'thumbnail'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Tasks()
    {
        return $this->hasMany(Task::class);
    }
}
