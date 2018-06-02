<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'image','title', 'description'
    ];

    public function courses() {
        return $this->hasMany('App\Models\Course');
    }
}
