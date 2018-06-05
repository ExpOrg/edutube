<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserBankAccount;

class UserBankAccountController extends Controller
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'account_name' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'mobile_number' => 'required|string',
            'nid_number' => 'required|string',
        ]);
    }

    /*
    * Create user_bank_account record of a student
    * @params education data
    * @return education data
    */
    public function create(Request $request) {
        $validate = $this->validator($request->all());
        if($validate->fails()) {
            return response()->json(['success' => false, 'message' => "Validation error", 'errors' => $validate->errors()]);
        }
        else {
            $user = auth()->user();
            $account_params = $request->all();
            $account_params['user_id'] = $user->id;
            $bank_account = new UserBankAccount();
            $bank_account = $bank_account->fill($account_params);
            if($bank_account->save()) {
                return response()->json(['success' => true, 'bank_account' => $bank_account]);
            }
            else {
                return response()->json(['success' => false, 'message' => "Unable to created bank account"]);
            }
        }
    }

    /*
    * Update user_bank_account
    * @return updated data
    */

    public function update(Request $request) {
        $validate = $this->validator($request->all());
        if($validate->fails()) {
            return response()->json(['success' => false, 'message' => "Validation error", 'errors' => $validate->errors()]);
        }
        else {
            $bank_account = UserBankAccount::find($request->id);
            $bank_account = $bank_account->fill($request->all());
            if($bank_account->save()) {
                return response()->json(['success' => true, 'message' => 'Course has been updated!', 'course' => $bank_account]);
            }
            else {
                return response()->json(['success' => false, 'message' => "Unable to update course"]);
            }
        }
    }

}
