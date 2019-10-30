<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }
    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }
}
