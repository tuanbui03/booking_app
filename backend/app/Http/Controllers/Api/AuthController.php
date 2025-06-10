<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Đăng nhập user (role_id = 3)
     */
    public function login(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Tìm user theo email
            $user = User::where('email', $request->email)->first();

            // Kiểm tra user tồn tại và password đúng
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email hoặc mật khẩu không đúng'
                ], 401);
            }

            // Kiểm tra role_id = 3
            if ($user->role_id != 3) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn không có quyền truy cập'
                ], 403);
            }

            // Tạo token (sử dụng Laravel Sanctum)
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'firstname' => $user->firstname,
                        'lastname' => $user->lastname,
                        'email' => $user->email,
                        'phone_number' => $user->phone_number,
                        'role_id' => $user->role_id,
                        'dob' => $user->dob,
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer'
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã có lỗi xảy ra',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Đăng nhập admin (role_id = 1)
     */
    public function loginAdmin(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Tìm user theo email
            $user = User::where('email', $request->email)->first();

            // Kiểm tra user tồn tại và password đúng
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email hoặc mật khẩu không đúng'
                ], 401);
            }

            // Kiểm tra role_id = 1 (Admin)
            if ($user->role_id != 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn không có quyền truy cập admin'
                ], 403);
            }

            // Tạo token với abilities cho admin
            $token = $user->createToken('admin_token', ['admin'])->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập admin thành công',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'firstname' => $user->firstname,
                        'lastname' => $user->lastname,
                        'email' => $user->email,
                        'phone_number' => $user->phone_number,
                        'role_id' => $user->role_id,
                        'dob' => $user->dob,
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'role' => 'admin'
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã có lỗi xảy ra',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Đăng nhập hotel manager (role_id = 2)
     */
    public function loginHotelManager(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Tìm user theo email
            $user = User::where('email', $request->email)->first();

            // Kiểm tra user tồn tại và password đúng
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email hoặc mật khẩu không đúng'
                ], 401);
            }

            // Kiểm tra role_id = 2 (Hotel Manager)
            if ($user->role_id != 2) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn không có quyền truy cập quản lý khách sạn'
                ], 403);
            }

            // Tạo token với abilities cho hotel manager
            $token = $user->createToken('hotel_manager_token', ['hotel-manager'])->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập quản lý khách sạn thành công',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'firstname' => $user->firstname,
                        'lastname' => $user->lastname,
                        'email' => $user->email,
                        'phone_number' => $user->phone_number,
                        'role_id' => $user->role_id,
                        'dob' => $user->dob,
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'role' => 'hotel_manager'
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã có lỗi xảy ra',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Đăng xuất user
     */
    public function logout(Request $request)
    {
        try {
            // Xóa token hiện tại
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Đăng xuất thành công'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã có lỗi xảy ra',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Lấy thông tin user hiện tại
     */
    public function me(Request $request)
    {
        try {
            $user = $request->user();

            return response()->json([
                'success' => true,
                'message' => 'Thông tin user',
                'data' => [
                    'id' => $user->id,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'email' => $user->email,
                    'phone_number' => $user->phone_number,
                    'role_id' => $user->role_id,
                    'dob' => $user->dob,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã có lỗi xảy ra',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Refresh token
     */
    public function refresh(Request $request)
    {
        try {
            $user = $request->user();

            // Xóa token cũ
            $request->user()->currentAccessToken()->delete();

            // Tạo token mới dựa trên role
            $tokenName = 'auth_token';
            $abilities = [];

            if ($user->role_id == 1) {
                $tokenName = 'admin_token';
                $abilities = ['admin'];
            } elseif ($user->role_id == 2) {
                $tokenName = 'hotel_manager_token';
                $abilities = ['hotel-manager'];
            }

            $token = $user->createToken($tokenName, $abilities)->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Token đã được làm mới',
                'data' => [
                    'token' => $token,
                    'token_type' => 'Bearer'
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã có lỗi xảy ra',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
