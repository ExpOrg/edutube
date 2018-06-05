<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'proficiency', 'user_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
