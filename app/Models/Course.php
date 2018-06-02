<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $serialize = ['tools_required', 'achivement', 'who_can_take'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'sub_title', 'description', 'language', 'is_test', 
        'status', 'tools_required', 'who_can_take', 'achivement', 'image', 
        'promo_video', 'price_currency', 'price', 'discount_currency',
        'discount_price', 'welcome_message', 'congratulation_message', 'privacy',
        'google_tracking_id', 'google_adwards', 'class_id', 'subject_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function subject() {
        return $this->belongsTo('App\Models\Subject');
    }

    public function klass() {
        return $this->belongsTo('App\Models\Klass', 'class_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

}
