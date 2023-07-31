<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use App\Helpers\FirebaseHelper;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ProfileRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
      public  $firebaseHelper;
      public function __construct()
      {
            $this->firebaseHelper = new FirebaseHelper();
      }
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
                  'sex' => 'required',
                  'birthday' => 'required',
                  'phone' => 'required|unique:users,phone'
                  // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                  return response()->json([
                        'status_code' => 422,
                        'message' => 'Validate error',
                        'errors' => $validator->errors(),
                  ], 422);
            } else {
                  $date = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $request->birthday);
                  $formattedDate = $date->format('Y-m-d');
                  $newUser['name'] = $request->name;
                  $newUser['email'] = $request->email;
                  $newUser['password'] = bcrypt($request->password);
                  $newUser['sex'] = $request->sex;
                  $newUser['phone'] = $request->phone;
                  $newUser['birthday'] =  $formattedDate;
                  $newUser['points'] = 0;
                  User::create($newUser);

                  return response()->json([
                        'status_code' => 201,
                        'message' => 'Register Success',
                  ], 201);
            }
            // Lưu ảnh đại diện nếu có

      }

      public function update(Request $request)
      {
            $path = 'Avatars/';
            $user = $request->user();
            $newUser = $request;
            if (!empty($request->password)) {
                  $user->password = bcrypt($newUser['password']);
            }
            if ($request->hasFile('image')) {
                  // $this->firebaseHelper->deleteImage($user->image, $path);
                  $image = $request->file('image');
                  $user->image = $this->firebaseHelper->uploadimageToFireBase($image, $path);
            }
            $user->name = $newUser['name'] ?? $user->name;
            $user->email = $newUser['email'] ?? $user->email;
            $user->phone = $newUser['phone'] ?? $user->phone;
            $user->sex = $newUser['sex'] ?? $user->sex;
            $user->birthday = $newUser['birthday'] ?? $user->birthday;
            $user->save();

            return response()->json([
                  'status_code' => 200,
                  'message' => 'Successfully',
                  'data' => $user->toArray()
            ], 200);
      }

      //login
      public function authenticate(Request $request)
      {
            try {
                  $request->validate([
                        'username' => 'required',
                        'password' => 'required'
                  ]);
                  if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
                        $credentials = [
                              'email' => $request->username,
                              'password' => $request->password
                        ];
                  } else {
                        $credentials = [
                              'phone' => $request->username,
                              'password' => $request->password
                        ];
                  }
                  $remember = $request->has('remember');
                  if (!Auth::attempt($credentials, $remember)) {
                        return response()->json([
                              'status_code' => 401,
                              'message' => 'Unauthorized'
                        ], 401);
                  }

                  $user = $request->user();
                  if ($user->role == 2) {
                        Auth::logout();
                        return response()->json([
                              'status_code' => 401,
                              'message' => 'Tài khoản đã bị khoá, hãy liên hệ admin để nhận trợ giúp',
                        ],  401);
                  }
                  $tokenResult = $user->createToken('authToken')->plainTextToken;
                  $refresh_token = $user->createToken('refresh_token')->plainTextToken;
                  return response()->json([
                        'status_code' => 200,
                        'message' => 'Login Success',
                        'auth' => [
                              'access_token' => $tokenResult,
                              'token_type' => 'Bearer',
                              'expires_at' => Carbon::now()->addHour(),
                              'refresh_token' => $refresh_token,
                              'email' => $user->email,
                              'phone' => $user->phone,
                        ],
                        'user' => [
                              'name' =>  $user->name,
                              'email' => $user->email,
                              'sex' => $user->sex,
                              'phone' => $user->phone,
                              'birthday' => $user->birthday,
                              'image' => $user->image,
                              'points' => $user->points,
                        ]
                  ],  200);
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
                  if ($user->remember_token) {
                        $user->remember_token = null;
                        $user->save();
                  }
                  $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
                  return response()->json([
                        'status_code' => 200,
                        'message' => 'Logout Success',
                  ], 200);
            } else {
                  return response()->json([
                        'status_code' => 409,
                        'message' => 'Logout Fail Or Account not Exist!!',
                  ], 409);
            }
      }


      public function get(Request $request)
      {
            $user = $request->user();
            $data = [
                  'name' =>  $user->name,
                  'email' => $user->email,
                  'sex' => $user->sex,
                  'phone' => $user->phone,
                  'birthday' => $user->birthday,
                  'image' => $user->image,
                  'points' => $user->points,
            ];
            return response()->json($data, 200);
      }
      public function changepassword(Request $request)
      {
            $user = $request->user();
            if (Hash::check($request->current_password, $user->password)) {
                  $user->update(['password' => bcrypt($request->new_password)]);
                  return response()->json('Đổi mật khẩu thành công', 200);
            }
            return response()->json('Mật khẩu hiện tại không đúng', 401);
      }
      public function sendcode(Request $request)
      {
            if (User::where('email', $request->email)->doesntExist()) {
                  return response()->json('Tài khoản KHÔNG tồn tại', 404);
            } else {
                  $email = $request->email;
                  DB::table('password_resets')->where('email', $email)->delete();
                  $pass_code = rand(11111, 99999);
                  DB::table('password_resets')->insert([
                        'email' => $email,
                        'token' => $pass_code,
                        'created_at' => Carbon::now(),
                        'expires_at' => Carbon::now()->addMinutes(15),
                  ]);
                  Mail::to($email)->send(new SendEmail($pass_code, $email));
                  return response()->json([
                        'email' => $email,
                        'message' => 'Email đã gửi thành công',
                  ], 200);
            }
      }

      public function checkcode(Request $request)
      {

            $check =  DB::table('password_resets')->where('email', $request->email)->where('token', $request->code)->get();
            if (!empty($check->toArray())) {
                  User::where('email', $request->email)->update(['password' => bcrypt($request->password)]);
                  DB::table('password_resets')->where('email', $request->email)->delete();
                  return response()->json(['message' => 'Đổi mật khẩu thành công'], 200);
            }
            return response()->json(['message' => 'Sai mã code xin mời kiểm tra lại'], 401);
      }
}
