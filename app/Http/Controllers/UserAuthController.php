<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\ProfilePicture;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;


class UserAuthController extends Controller
{
    /*
        signup method
            Params
                    * username (string)
                    * password (string)
                    * password_confirmation (string)
                    * email (string)
                    * name (string)
                    * phone (string)

      */

    public function register(RegisterRequest $request)
    {
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
        ]);
        $profile = new UserProfile([
            'address' => $request->address,
            'skype_username' => $request->skype_username,
            'dob' => $request->dob,
        ]);
        $user->save();
        //save profile
        $user->profile()->save($profile);
        //
        $img_url = new ProfilePicture([
            'img_url' => $request->img_url,
        ]);
        //save image
        $profile->profile_img()->save($img_url);


        return response()->json([
            'message' => 'User created'
        ], 201);
    }



    /*
        login method
            Params
                    * username (string)
                    * password (string)
                    * c (boolean)
                    * access_token (string)
                    * token_type (string)
                     * expires_at (string)
      */


    public function login(LoginRequest $request)
    {

        $credentials = request(['username', 'password']);
        //login fail
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        //
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

        /*

            Logout .
                    Revoke the token
        */

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'logged out'
        ]);
    }

        /*
                Get authenticate user

        */
    public function user(Request $request)
    {
        $user = User::with('profile', 'profile.profile_img')->find($request->user()->id);
        return response()->json($user);
    }

}

