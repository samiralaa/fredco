<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController
{
    
  function totalUsers ()
    {
        $totalusers = DB::table('users')->count();
        return response()->json(['total'=>$totalusers]);
    }

    public function index()
    {

        $users = User::with('media')->paginate(10);
        return response()->json([
            'users' => $users,
            'status' => 'success'
        ]);
    }

    public function show($id)
    {

        $user = User::where('id', $id)->first();
        if (!$user) {
            return response()->json(['notFound' => 'المستخدم غير موجود'], 404);
        }
        return response()->json([
            'user' => $user,

        ]);
    }

   public function store(UserRequest $request)
{
      $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6',
            // Add other rules as needed
        ];

        // Validate the request
        $request->validate($rules);
    $users = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'phone' => $request->phone,
        'password' => Hash::make($request->password) // Hash the password
    ]);

    if ($request->hasFile('image')) {
        $users->addMediaFromRequest('image')
              ->toMediaCollection('user'); // Make sure 'user' collection is configured in media library
    }

    // Use getUrl() to get the web-accessible URL
    $url = $users->getFirstMediaUrl('user'); // 'user' is the name of the collection

    return response()->json([
        'success' => 'تم إضافة المستخدم بنجاح',
        'data' => $url
    ], 200);
}

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->phone = $request->phone;

        // ... update other fields ...

        // Only update the password if it's provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return response()->json(['success' => 'تم تعديل المستخدم بنجاح'], 200);
    }



    function login(Request $request)
    {

        $request->validate([
            'email' => 'required', 'exists:users,email', 'email',
            'password' => 'required', 'string', 'max:255',
        ]);

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'email Or password invalid'
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
            'msg' => 'Login successfully!',
            'accessToken' => $token,
            'token_type' => 'Bearer',
            'user' => Auth::user()
        ], 200);
    }
    public function logout(Request $request)
    {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json([
            'message' => 'Logged out successfully!',
            'status_code' => 200
        ], 200);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'message' => 'تم حذف المستخدم بنجاح'
        ], 202);
    }
}
