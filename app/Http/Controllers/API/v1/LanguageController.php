<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Language;

class LanguageController extends Controller
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
     * Get user language lists.
     *
     * @param  none
     * @return Array language
     */
    protected function index()
    {
        $user = auth()->user();
        return response()->json(['success' => true, 'languages' => $user->languages()->get()]);
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
            'name' => 'required|string',
            'proficiency' => 'required|string|'
        ]);
    }

    /*
    * Create language record of a student
    * @params language data
    * @return language data
    */
    public function create(Request $request) {
      $validate = $this->validator($request->all());
      if($validate->fails()) {
        return response()->json(['success' => false, 'message' => "Validation error! Please fill the required field.", 'errors' => $validate->errors()]);
      } 
      else {
        $user = auth()->user();
        $language_params = $request->all();
        $language_params['user_id'] = $user->id; 
        $language = new Language();
        $language = $language->fill($language_params);
        if($language->save()) {
          return response()->json(['success' => true, 'language' => $language]);
        }
        else {
          return response()->json(['success' => false, 'message' => "Unable to created language"]);
        }
      }
    }

    /*
    * Update language record of a student
    * @params language id as integer
    * @return updated data
    */
    public function update(Request $request) {
      $validate = $this->validator($request->all());
      if($validate->fails()) {
        return response()->json(['success' => false, 'message' => "Validation error! Please fill the required field.", 'errors' => $validate->errors()]);
      } 
      else {
        $language = Language::find($request->id);
        $language = $language->fill($request->all());
        if($language->save()) {
          return response()->json(['success' => true, 'language' => $language]);
        }
        else {
          return response()->json(['success' => false, 'message' => "Unable to created language"]);
        }
      }
    }
}
