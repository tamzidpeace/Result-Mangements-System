<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cgpa extends Model
{
    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
