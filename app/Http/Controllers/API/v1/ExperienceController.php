<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Experience;

class ExperienceController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Get user experience lists.
     *
     * @param  none
     * @return Array experience
     */
    protected function index()
    {
        $user = auth()->user();
        return response()->json(['success' => true, 'experiences' => $user->experiences()->get()]);
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
            'designation' => 'required|string',
            'institution' => 'required|string|'
        ]);
    }

    /*
    * Create experience record of a student
    * @params experience data
    * @return experience data
    */
    public function create(Request $request) {
      $validate = $this->validator($request->all());
      if($validate->fails()) {
        return response()->json(['success' => false, 'message' => "Validation error", 'errors' => $validate->errors()]);
      } 
      else {
        $user = auth()->user();
        $edu_params = $request->all();
        $edu_params['user_id'] = $user->id; 
        $experience = new Experience();
        $experience = $experience->fill($edu_params);
        if($experience->save()) {
          return response()->json(['success' => true, 'experience' => $experience]);
        }
        else {
          return response()->json(['success' => false, 'message' => "Unable to created experience"]);
        }
      }
    }

    /*
    * Update experience record of a student
    * @params experience id as integer
    * @return updated data
    */
    public function update(Request $request) {
      $validate = $this->validator($request->all());
      if($validate->fails()) {
        return response()->json(['success' => false, 'message' => "Validation error", 'errors' => $validate->errors()]);
      } 
      else {
        $experience = Experience::find($request->id);
        $experience = $experience->fill($request->all());
        if($experience->save()) {
          return response()->json(['success' => true, 'experience' => $experience]);
        }
        else {
          return response()->json(['success' => false, 'message' => "Unable to created experience"]);
        }
      }
    }
}
