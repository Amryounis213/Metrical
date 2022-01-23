<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AccessTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signUp(Request $request)
    {
        /* $validation = $request->validate([
            'first_name' => 'required| string',
            'last_name' => 'required| string',
            'email' => 'required|unique:users,email|email',
            'country' => 'required',
            'city' => 'required',
            'mobile_number' => 'required| string ',
            'password' => [Password::min(8), 'confirmed', 'required'],
            'password_confirmation',
            'agree' => 'required',
        ]);*/

        $validation = Validator::make($request->all(), [
            'first_name' => 'required| string',
            'last_name' => 'required| string',
            'email' => 'required|unique:users,email|email',
            'country' => 'required',
            'city' => 'required',
            'mobile_number' => 'required| string ',
            'password' => [Password::min(8), 'confirmed', 'required'],
            'password_confirmation',
            'agree' => 'required',
        ]);
        if ($validation->fails()) {

            return  response()->json([
                'status' => true,
                'code' => 401,
                'message' => '',
                'data' => $validation->errors(),
            ], 401);
        }
        $request->merge([
            'password' => Hash::make($request->password),
            'code' => mt_rand(1111, 9999),
        ]);

        $user = User::create($request->all());
        return  response()->json([
            'status' => true,
            'code' => 201,
            'message' => 'please send code to database',
            'data' => $user,
        ], 201);
    }

    public function sendCode(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);
        $email = trim($request->email);
        $user = User::where('email', $email)->first();
        if (!$user) {

            return  response()->json(
                [
                    'status' => false,
                    'code' => 404,
                    'message' => 'User not found',
                    'data' => ''
                ],
                404
            );
        }
        
        $user->update([
            'code' => mt_rand(1111, 9999),
        ]);

        return  response()->json(
            [
                'status' => true,
                'code' => 201,
                'message' => 'the code was send',
                'data' => $user
            ],
            201
        );
    }

    public function checkCode(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'email' => 'required',
            'device_name' => 'required',
        ]);


        $email = trim($request->email);
        $user = User::where('email', $email)->first();

        if ($user->code === $request->code) {

            $user->update([
                'email_verified_at' => now()
            ]);
            $token = $user->createToken($request->device_name);
            return  response()->json(
                [
                    'status' => true,
                    'code' => 201,
                    'message' => 'Validation code is correct',
                    'token' =>  $token->plainTextToken,
                    'data' => $user,
                ],
                200
            );
        }
        return  response()->json(
            [

                'status' => false,
                'code' => 401,
                'message' => 'Invalid verification code',
                'data' => ''
            ],
            401
        );
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'email' => ['required'],
            'device_name' => ['required'],
            'password' => 'required'
        ]);
        $email = trim($request->email);

        $user = User::where('email', $email)
            ->first();
        //    return $user->password;
        if (
            !$user || !Hash::check($request->password, $user->password)
        ) {
            // RateLimiter::hit($this->throttleKey());
            return  response()->json(
                [
                    'status' => false,
                    'code' => 404,
                    'message' => 'your email or password not valid',
                    'data' => null
                ],
                404
            );
            
        }
        
        if($user->email_verified_at == null){
            return  response()->json(
                [
                    'status' => false,
                    'code' => 404,
                    'message' => 'your account not Verified',
                    'data' => null
                ],
                404
            );
        }

        if ($user->email_verified_at == null) {
            return  response()->json(
                [
                    'status' => false,
                    'code' => 404,
                    'message' => 'Your account is not Verified',
                    'data' => null
                ],
                404
            );
        }
        $token = $user->createToken($request->device_name);
        $user->update([
            'code' => null
        ]);
        /*  return  response()->json([
            'status' => '200',
            'message' => 'Login success',
            '' => [
                'token' => $token->plainTextToken,
                'user' =>  $user,
            ]
        ], 200);*/
        return  response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Login success',
            'token' => $token->plainTextToken,
            'user' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = Auth::guard('sanctum')->user();

        // Revoke (delete) all user tokens
        //$user->tokens()->delete();

        // Revoke current access token
        $user->currentAccessToken()->delete();
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'The user is logout',
            'user' => null
        ], 200);
    }

    public function beforeUpdate(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);
        $email = trim($request->email);
        $user = User::where('email', $email)->first();

        if (!$user) {
            return  response()->json(
                [
                    'status' => false,
                    'code' => 404,
                    'message' => 'user not found',
                    'data' => ''
                ],
                404
            );
        }
        return  response()->json(
            [
                'status' => true,
                'code' => 200,
                'message' => 'user exisit',
                'user' => $user
            ],
            200
        );
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => [Password::min(8), 'confirmed', 'required'],
            'password_confirmation',
            'email' => 'required'
        ]);
        $email = trim($request->email);
        $user = User::where('email', $email)->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return  response()->json(
            [
                'status' => true,
                'code' => 200,
                'message' => 'password was updated',
                'user' => $user
            ],
            200
        );
    }

    public function requestAsTenant(Request $request)
    {
        // return $request;
        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
        ]);
        $request->validate([
            'community_id' => 'required|exists:communities,id',
            'passport' => 'required| file',
            'visa' => 'required | file',
            'unit_number' => 'required',

        ]);

        $user = Auth::guard('sanctum')->user();
        $user1 = User::findOrFail($request->user_id);
        $user1->update([
            'status' => '0',


        ]);


        if ($request->hasFile('passport')) {
            if ($user->passport_copy !== null) {

                unlink(public_path('upload/' . $user->passport_copy));
            }
            $uploadedFile = $request->file('passport');

            $passport_copy = $uploadedFile->store('/', 'upload');
            $request->merge([
                'passport_copy' => $passport_copy
            ]);
        }
        if ($request->hasFile('visa')) {
            if ($user->visa_copy !== null) {

                unlink(public_path('upload/' . $user->visa_copy));
            }
            $uploadedFile = $request->file('visa');

            $visa_copy = $uploadedFile->store('/', 'upload');
            $request->merge([
                'visa_copy' => $visa_copy
            ]);
        }
        $user1->update([
            'type' => '0',
            'request_sent' => '1',
            'need' => 'tenant',
        ]);

        $tenants = Tenant::create($request->all());

        return  response()->json(
            [
                'status' => true,
                'code' => 200,
                'message' => 'Your request has been sent We will contact you shortly Successfully',
                'data' => $tenants,
            ],
            200
        );
    }

    public function requestAsOwner(Request $request)
    {
        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
        ]);
        $request->validate([
            'community_id' => 'required|exists:communities,id',
            'passport' => 'required',
            'title_dead' => 'required',
            'emirate_id' => 'required',
            'unit_number' => 'required',
            'renting_price' => 'required',
            'direct' => 'required',

        ]);

        $user = Auth::guard('sanctum')->user();


        if ($request->hasFile('passport')) {
            if ($user->passport_copy !== null) {

                unlink(public_path('upload/' . $user->passport_copy));
            }
            $uploadedFile = $request->file('passport');

            $passport_copy = $uploadedFile->store('/', 'upload');
            $request->merge([
                'passport_copy' => $passport_copy
            ]);
        }
        if ($request->hasFile('title_dead')) {
            if ($user->title_dead_copy !== null) {

                unlink(public_path('upload/' . $user->title_dead_copy));
            }
            $uploadedFile = $request->file('title_dead');

            $title_dead_copy = $uploadedFile->store('/', 'upload');
            $request->merge([
                'title_dead_copy' => $title_dead_copy
            ]);
        }
        $user1 = User::findOrFail($request->user_id);
        $user1->update([
            'type' => '0',
            'status' => '0',
            'request_sent' => '1',
            'need' => 'owner',
        ]);


        $owner = Owner::create($request->all());


        return  response()->json(
            [
                'status' => true,
                'code' => 200,
                'message' => 'your request as Owner is submitted',
                'data' => $owner
            ],
            200
        );
    }

    public function terms(Request $request)
    {
        $value = $request->header('lang');

        if ($value == 'ar') {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'terms message',
                'user' => User::$term_ar
            ]);
        }
        if ($value == 'gr') {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'terms message',
                'user' => User::$term_en
            ]);
        }

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'terms message',
            'user' => User::$term_en
        ]);
    }


    public function changePass(Request $request)
    {
        $request->validate([
            'current_pass' => 'required',
            'password' => [Password::min(8), 'confirmed', 'required'],
            'password_confirmation',
        ]);

        $user = Auth::guard('sanctum')->user();

        if (!Hash::check($request->current_pass, $user->password)) {
            // RateLimiter::hit($this->throttleKey());
            return  response()->json(
                [
                    'status' => false,
                    'code' => 404,
                    'message' => 'current password not valid',
                    'data' => null
                ],
                404
            );
        }

        $user->update([
            'password' => Hash::make($request->new_pass)
        ]);

        return response()->json([
            'status' => true,
            'code' => 201,
            'message' => 'password was updated',
            'user' => ''
        ], 201);
    }
}
