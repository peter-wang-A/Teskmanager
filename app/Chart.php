<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Message;

class Chart extends Model
{
    protected $fillable = [
        'user_one', 'user_two'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
