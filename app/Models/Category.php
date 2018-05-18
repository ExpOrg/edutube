<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'image','title', 'description'
    ];

    public function courses()
    {
        return $this->belongsToMany('App\Models\Course');
    }

}
