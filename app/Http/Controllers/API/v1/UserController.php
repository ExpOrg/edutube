<?php
namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
    }

    public function update_profile(Request $request) {
        $user = auth()->user();
        if($user) {
          $user->fill($request->all());
          if($user->save()) {
            return response()->json(['success' => true, 'message' => "Profile imformation saved!"]);
          }
          else {
            return response()->json(['success' => false, 'message' => "Unable to update user profile!"]);
          }
        }
        else {
            return response()->json(['success' => false, 'message' => "User not found!"]);
        }
    }
}