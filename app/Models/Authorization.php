<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Authorization extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'provider', 'uid', 'picture', 'email', 'token'
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
    * Find auth user
    */
    public static function find_auth_user($uid, $email) {
      $provider = Authorization::where("uid", $uid)->first();
      if($provider) {
        return User::find($provider->user_id);
      }
      else {
        return User::where('email', $email)->first();
      }
    }
}
