<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'designation', 'institution', 'details', 'subject', 'country', 'city',
        'from_year', 'from_month', 'to_year', 'to_month', 'is_continue', 'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
