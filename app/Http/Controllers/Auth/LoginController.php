<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Models\Authorization;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['login', 'social_login']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
    * Social login
    *
    */
    public function social_login(Request $request) {
        $user = Authorization::find_auth_user($request->id, $request->email);
        if(!$user) {
          $user_data = $request->only('name', 'email');
          $user_data['password'] = '369258741';
          $user_data['password_confirmation'] = '369258741';
          $validation = $this->validator($user_data);
          if($validation->fails()) {
            return response()->json(['success' => false, 'message' => 'Unable to login', 'errors' => $validation->errors()]);  
          }
          else {
             $user = User::create($user_data);
             Authorization::create(['user_id' => $user->id, 'provider' => $request->provider, 'uid' => $request->id, 'email' => $request->email, 'picture' => $request->picture, 'token' => $request->token]);
          }
        }
        $token = JWTAuth::fromUser($user);
        auth()->login($user);
        return $this->respondWithToken($token);
    }

    public function login(Request $request) {
        $auth = false;
        $credentials = $request->only('email', 'password');

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['success' => false, 'message' => 'Invalid email or password!']);
        }

        return $this->respondWithToken($token);
    }

    /**
    * Get current auth user
    *
    * @return user details
    */

    public function me() {
      return auth()->user();
    }

    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }

     /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'user' => auth()->user(),
            'success' => true,
            'message' => 'auth success',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
