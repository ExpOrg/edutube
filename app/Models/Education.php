<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'institution', 'website', 'degree', 'subject', 'country', 'city',
        'from_year', 'from_month', 'to_year', 'to_month', 'details', 'is_continue'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
