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
        'google_tracking_id', 'google_adwards'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
