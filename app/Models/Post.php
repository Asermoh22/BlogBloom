<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=[
        'title','desc','img','user_id'
    ];

    public function users(){
        return $this->belongsTo('App\Models\User');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Category');
    }
}
