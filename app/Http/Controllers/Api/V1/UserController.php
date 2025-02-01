<?php

namespace App\Http\Controllers\APi\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Ensure the limit is not more than 50 or set it to 15 by default
        $limit = $request->input('limit') <= 50 ? $request->input('limit') : 15;

        // Paginate and wrap users in a resource collection
        $users = UserResource::collection(User::paginate($limit));

        // Return users with a 200 HTTP status code
        return $users->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // if (Auth::check()) {
        //
        // } else {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        if (User::where('email', $request->email)->exists()) {
            return response()->json(['error' => 'Email already in use.'], 400);
        }
        // $this->authorize('create', User::class);
        $user = new UserResource(User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user',
        ]));

        return $user->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = new UserResource(User::findOrFail($id));

        // Return the user along with a custom header and a success message
        return $user->response()->setStatusCode(200, "User Returned Successfully")
            ->header('Additional Header', 'True');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Find the user to be updated
        $userToUpdate = User::findOrFail($id);

        // Authorize the update action using the policy
        $this->authorize('update', $userToUpdate);

        // Hash the password if it is being updated
        if ($request->filled('password')) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        // Update the user's information
        $userToUpdate->update($request->all());

        // Wrap the updated user in a resource and return the response
        $updatedUser = new UserResource($userToUpdate);
        return $updatedUser->response()->setStatusCode(200, "User Updated Successfully");
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find the user by ID or fail
        $user = User::findOrFail($id);

        // Authorize the action based on policy
        // $this->authorize('delete', $user);

        // Delete the user
        $user->delete();

        // Return a 204 status code (No Content)
        return response()->noContent();
    }
}
