<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only(['index', 'destroy']);
    }
    public function index()
    {
        $users = User::query()
            ->select(['id','name','email'])
            ->get();
        return response()->json($users);
    }

    public function store(StoreUserRequest $request)
    {
        auth()->user()->create([
            'name' => Arr::get($request, 'name'),
            'email' => Arr::get($request, 'email'),
            'password' => Hash::make(Arr::get($request, 'password')),
            'is_admin' => Arr::get($request, 'is_admin'),
        ]);
        return response()->json([
            'message' => 'User created successfully'
        ],201);
    }

    public function show(User $user)
    {
        return response()->json([
            'id' => $user->id,
            'name'=> $user->name,
            'email' => $user->email
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->method()=== 'PUT'){
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);
        }else{

            $data = [];

            if ($request->has('name')){
                $data['name'] = $request->input('name');
            }

            if ($request->has('email')){
                $data['email'] = $request->input('email');
            }

            $user->update($data);
            return response()->json([
                'id'=> $user->id,
                'name'=> $user->name,
                'email'=>$user->email
            ]);
        }
        return response()->json([
            'id'=> $user->id,
            'name'=> $user->name,
            'email'=>$user->email
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}
