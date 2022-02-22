<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Resources\UserResource;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{

    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function store(StoreRequest $request)
    {
        $user = User::create($request->validated());
        return new UserResource($user);
    }

    public function show($id)
    {
        return new UserResource(User::findOrFail($id));
    }

    public function update(UpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return new UserResource($user);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

}
