<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Education;
use App\User;

class EducationController extends Controller
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
     * Get user education lists.
     *
     * @param  none
     * @return Array education
     */
    protected function index()
    {
        $user = auth()->user();
        $institutions = User::whereNotNull('institution')->select('institution')->distinct()->get();
        return response()->json(['success' => true, 'educations' => $user->educations()->get(), 'institutions' => $institutions]);
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
            'institution' => 'required|string',
            'degree' => 'required|string|'
        ]);
    }

    /*
    * Create education record of a student
    * @params education data
    * @return education data
    */
    public function create(Request $request) {
      $validate = $this->validator($request->all());
      if($validate->fails()) {
        return response()->json(['success' => false, 'message' => "Validation error! Please fill the required field.", 'errors' => $validate->errors()]);
      } 
      else {
        $user = auth()->user();
        $edu_params = $request->all();
        $edu_params['user_id'] = $user->id; 
        $education = new Education();
        $education = $education->fill($edu_params);
        if($education->save()) {
          return response()->json(['success' => true, 'education' => $education]);
        }
        else {
          return response()->json(['success' => false, 'message' => "Unable to created education"]);
        }
      }
    }

    /*
    * Update education record of a student
    * @params education id as integer
    * @return updated data
    */
    public function update(Request $request) {
      $validate = $this->validator($request->all());
      if($validate->fails()) {
        return response()->json(['success' => false, 'message' => "Validation error! Please fill the required field.", 'errors' => $validate->errors()]);
      } 
      else {
        $education = Education::find($request->id);
        $education = $education->fill($request->all());
        if($education->save()) {
          return response()->json(['success' => true, 'education' => $education]);
        }
        else {
          return response()->json(['success' => false, 'message' => "Unable to created education"]);
        }
      }
    }
}
