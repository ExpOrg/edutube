<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    public function assessmentable()
    {
        return $this->morphTo();
    }

    public function questions() {
        return $this->hasMany('App\Models\Question','assessment_id');
    }
}
