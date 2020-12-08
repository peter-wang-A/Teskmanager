<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Chart;
use App\User;

class Message extends Model
{
    protected $fillable = [
        'user_id', 'message', 'chat_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function chat()
    {
        return $this->belongsTo(Chart::class);
    }
}
