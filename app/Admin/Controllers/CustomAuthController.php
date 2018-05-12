<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomAuthController extends AuthController
{

    public function postLogin(Request $request)
    {
        $credentials = $request->only([$this->username(), 'password']);

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($credentials, [
            $this->username()   => 'required',
            'password'          => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        if ($this->guard()->attempt($credentials)) {
            return $this->sendLoginResponse($request);
        }

        return back()->withInput()->withErrors([
            $this->username() => $this->getFailedLoginMessage(),
        ]);
    }

    protected function sendLoginResponse(Request $request)
    {
        admin_toastr(trans('admin.login_successful'));

        $request->session()->regenerate();

        return redirect('admin/website_users');
    }
}