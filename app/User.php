<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Project;
use App\Task;
use App\Message;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login_at'
    ];

    protected $dates = ['last_login_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function projects()
    {
        return  $this->hasMany(Project::class);
    }
    //当前用户的 Tasks
    public function tasks()
    {
        return $this->hasManyThrough(Task::class, Project::class);
    }

    //当前用户的 messages
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
