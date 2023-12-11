<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{

    public function __construct(public UserService $service){}

    public function index(){
        $users = User::orderBy('created_at', 'desc')->paginate(6);
        return UserResource::collection($users);
    }

    public function store(UserRequest $request){
        $user = $this->service->create($request->all());
        return new UserResource($user);
    }


}
