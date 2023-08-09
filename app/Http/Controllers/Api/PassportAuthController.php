<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PassportAuthController extends Controller
{
    public function register(Request $request)
    {
        try {

            $this->validate($request, [
                'name' => 'required',
                'username' => 'nullable|unique:users',
                'phone' => ['nullable', 'regex:/^(\\+|00)(\\d{11}|\\d{12})$/i', 'unique:users'],
                'email' => 'required|email|unique:users',
                'password' => 'required|min:3',
            ]);

            $user = new User();

            // Generate a random username if it is not provided as a string
            if (is_string($request->username)) {
                $user->username = $request->username;
            } else {
                $now = Carbon::now();
                $user->username = 'USER_' . Str::random(8) . '_' . $now->year . '_' . $now->month . '_' . $now->day . '_' . $now->second; // Generate a random username of 8 characters + add to it Year m day seconds
            }

            $user->name        = $request->name;
            $user->email       = $request->email;
            $user->phone      = $request->phone;
            $user->password    = bcrypt($request->password);

            $user->save();

            $token = $user->createToken('auth_Token_Khaled_Labedia')->accessToken;

            return response([
                'user' => $user,
                'token' => $token
            ], Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return response(['error' => 'Validation failed.', 'errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response(['error' => 'An error occurred during registration.', 'message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                $user = $request->user();

                // Revoke all old token for avoid open the app on multi device
                ////
                /// = way .1 : 
                // DB::table('oauth_access_tokens')
                //     ->where('user_id', Auth::user()->id)
                //     ->update([
                //         'revoked' => true
                //     ]);
                ///
                /// =  way .2 : 
                $user->tokens()->delete();

                $token = $user->createToken('auth_Token_Khaled_Labedia')->accessToken;

                return response([
                    'user' => $user,
                    'token' => $token
                ], Response::HTTP_OK);
            }

            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        } catch (ValidationException $e) {
            return response(['error' => 'Validation failed.', 'errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response(['error' => 'An error occurred during login.', 'message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function getUser(Request $request)
    {
        return $request->user();
    }

    public function updateToken(Request $request)
    {
        $user = $request->user();
        $token = $user->createToken($request->input('name'));

        return $token->accessToken;
    }

    public function checkToken(Request $request)
    {
        $token_info = $request->user()->token();
        // return $token_info;

        // Token Expired
        if ($token_info->expires_at < now()) {
            $request->user()->token()->revoke();
            $newToken = $request->user()->createToken('auth_Token_Khaled_Labedia')->accessToken;
            return response([
                'token' => $newToken,
                'message' => "Token Refreshed"
            ], Response::HTTP_OK);
        }

        return response([
            'token' => null,
            'message' => "Token is valid"
        ], Response::HTTP_ACCEPTED);
    }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }

    // If you want to log out from all the devices
    public function logout_all(Request $request)
    {
        DB::table('oauth_access_tokens')
            ->where('user_id', Auth::user()->id)
            ->update([
                'revoked' => true
            ]);


        return response([
            'message' => "logged out from all devices successfully"
        ], Response::HTTP_OK);
    }
}
