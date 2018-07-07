<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	protected $table = 'question_choices';

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }
}
