<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBankAccount extends Model
{
    protected $fillable = [
        'account_name','bank_name', 'account_number', 'mobile_number', 'nid_number', 'bkash_number', 'details', 'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
