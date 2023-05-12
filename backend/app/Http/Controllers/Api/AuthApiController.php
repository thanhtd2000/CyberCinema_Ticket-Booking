<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
    public function register(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return response()->json([
                'status_code' => 409,
                'message' => 'Account already exists ',
            ], 409);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 422,
                'message' => 'Validate error',
                'errors' => $validator->errors(),
            ], 422);
        } else {

            if ($request->hasFile('image')) {
                $file = $request->image;
                $fileExtension = $file->getClientOriginalExtension();
                $file->move("uploads", $request->email . "." . $fileExtension);
                $newUser['image'] = $request->email . "." . $fileExtension;
            }
            $newUser['name'] = $request->name;
            $newUser['email'] = $request->email;
            $newUser['role'] = $request->role;
            $newUser['password'] = bcrypt($request->password);
            User::create($newUser);

            return response()->json([
                'status_code' => 201,
                'message' => 'Register Success',
            ], 201);
        }
        // Lưu ảnh đại diện nếu có

    }

    // public function store(UserRequest $request)
    // {
    //     if (User::where('email', $request->email)->doesntExist()) {

    //         $newUser = $request->validated();
    //         if ($request->hasFile('avatar')) {
    //             $file = $request->avatar;
    //             $fileExtension = $file->getClientOriginalExtension();
    //             $file->move("uploads", $request->email . "." . $fileExtension);
    //         }
    //         $newUser['password'] = bcrypt($request->password);
    //         $newUser['avatar'] = $request->email . "." . $fileExtension;

    //         User::create($newUser);

    //         return response()->json([
    //             'status_code' => 201,
    //             'message' => 'Register Success',
    //         ], 201);
    //     } else {

    //         return response()->json([
    //             'status_code' => 409,
    //             'message' => 'Account already exists ',
    //         ], 409);
    //     }
    // }

    //login
    public function authenticate(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'status_code' => 401,
                    'message' => 'Unauthorized'
                ], status: 401);
            }

            $user = $request->user();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status_code' => 200,
                'message' => 'Login Success',
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ], status: 200);
        } catch (ValidationException $error) {
            return response()->json([
                'status_code' => 422,
                'message' => 'Invalid input',
                'errors' => $error->errors(),
            ], 422);
        } catch (AuthenticationException $error) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Unauthorized',
                'errors' => $error->getMessage(),
            ], 401);
        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'errors' => $error->getMessage(),
            ], 500);
        }
    }


    //logout from
    public function logout(Request $request)
    {
        if ($user = $request->user()) {
            $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
            return response()->json([
                'status_code' => 200,
                'message' => 'Logout Success',
            ], status: 200);
        } else {
            return response()->json([
                'status_code' => 409,
                'message' => 'Logout Fail Or Account not Exist!!',
            ], status: 409);
        }
    }
}
