<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function assessment()
    {
        return $this->belongsTo('App\Models\Assessment', 'assessment_id');
    }

    public function answers() {
        return $this->hasMany('App\Models\Answer','question_id');
    }
}
