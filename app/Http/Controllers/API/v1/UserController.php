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

    /*
    * Get courses created by an user
    * @input user auth
    * @return Course list as Array
    */

    public function getCourses() {
      $user = auth()->user();
      $courses = $user->courses();
       return response()->json(['success' => true, 'message' => "Load courses", 'courses' => $courses]);
    }

    /**
     * Upload user avatar.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload_avatar(Request $request) {
        $user = auth()->user();
        $this->validate($request, [
          'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
          $image = $request->file('avatar');
          $name = time().'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path('/upload/users/');
          $image->move($destinationPath, $name);
          $avatar_path = '/upload/users/'.$name;
          $user->fill(['avatar' => $avatar_path]);
          if($user->save()) {
            return response()->json(['success' => true, 'message' => "Profile imformation saved!", 'avatar' => $avatar_path ]);
          }
          else {
            return response()->json(['success' => false, 'message' => 'Unable to upload image']);
          }
        }
    }
}