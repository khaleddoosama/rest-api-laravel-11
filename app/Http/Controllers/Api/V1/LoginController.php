<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\UserLoggedIn;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
     

    public function login(Request $request)
{
    // Validate the incoming login request
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => 'Validation failed', 'messages' => $validator->errors()], 422);
    }

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::user();
        
        event(new UserLoggedIn($user));
        // Create a personal access token for the user (Sanctum)
        $accessToken = $user->createToken('Access Token')->plainTextToken;

        return response()->json([
            'User' => new UserResource($user),
            'Access Token' => $accessToken,
        ]);
    }

    return response()->json(['error' => 'Unauthorized'], 401);
}
    
}