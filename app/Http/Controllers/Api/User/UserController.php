<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->all();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->create($request->validated());
        if ($request->hasFile('image')) {
            $user->addMediaFromRequest('image')->toMediaCollection('avatar');
        }
        return UserResource::make($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userService->show($id);
        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = $this->userService->update($id,$request->validated());
        if ($request->hasFile('image')) {
            $user->addMediaFromRequest('image')->toMediaCollection('avatar');
        }
        return response()->json(['message' => "Done"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userService->destroy($id);
        return response()->json(['message' => "Done"],200);
    }
}
