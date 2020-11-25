<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'thumbnail'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
