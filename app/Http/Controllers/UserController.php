<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @var int $status_code - okay
     */
    private int $status_code = 200;

    /**
     * User registration.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function userSignUp(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'validation_error',
                'errors' => $validator->errors(),
            ]);
        }

        $userDataArray = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password),
        ];

        $user_status = User::where('email', $request->email)->first();

        if (!is_null($user_status)) {
            return response()->json([
               'status' => 'failed',
               'success' => 'false',
               'message' => 'This email is already registered'
            ]);
        }

        $user = User::create($userDataArray);

        if (!is_null($user)) {
            return response()->json([
                'status' => $this->status_code,
                'success' => TRUE,
                'message' => 'Registration completed',
                'data' => $user,
            ]);
        }
        else {
            return response()->json([
                'status' => 'failed',
                'success'=> 'false',
                'message' => 'failed',
            ]);
        }
    }

    /**
     * User login.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
            ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'validation_error' => $validator->errors()]);
        }

        $email_status = User::where('email', $request->email)->first();

        if (!is_null($email_status)) {
            $password_status = User::where('email', $request->email)
                ->where('password', md5($request->password))
                ->first();

            if (!is_null($password_status)) {

                $user = $this->userDetail($request->email);
                return response()->json([
                    'status' => $this->status_code,
                    'success' => true,
                    'message' => 'You have logged in successfully',
                    'data' => $user]);
            }
            else {
                return response()->json([
                    'status' => 'failed',
                    'success' => false,
                    'message' => 'Unable to login. Incorrect password.'
                ]);
            }
        }
        else {
            return response()->json([
                'status' => 'failed',
                'success' => false,
                'message' => 'Unable to login. Email does not exist.'
            ]);
        }
    }

    public function userDetail($email) {
        $user = [];
        if($email != '') {
            $user = User::where('email', $email)->first();
            return $user;
        }
    }

}

