<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable=[
        'user','ip','path','query','method','platform','browser','referer'
    ];
}
