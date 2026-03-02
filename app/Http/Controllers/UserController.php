<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserValidateRequest;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        
    }


    public function store(UserValidateRequest $request)
    {
        $validateData = $request->validated();
        $validateData['password'] = Hash::make($validateData['password']);

        $user = User::create($validateData);
        $token = $user->createToken("api_token")->plainTextToken;

        return response()->json([
            "message" => "ok",
            "data" => $user,
            "token" => $token
        ], 201);

    }

    public function authenticate(UserValidateRequest $request) {
        $validateData = $request->validated();

        if(Auth::attempt($validateData)) {
            $user = Auth::user();
            $token = $user->createToken("authenticate_token")->plainTextToken;

            return response()->json([
                "message" => "ok",
                "data" => $user,
                "token" => $token
            ], 200);
        }

        return response()->json([
            "message" => "error"
        ], 400);
    }


    public function show(string $id)
    {
        if(Auth::check()) {
            $user = User::find($id);
            
            if(!$user) {
                return response()->json([
                    "message" => "not found"
                ], 400);
            }

            return response()->json([
                "message" => "ok",
                "data" => $user,
            ]);
        }

        return response()->json([
            "Message" => "not authenticable",

        ], 400);
    }

 
    public function update(UserValidateRequest $request, string $id)
    {
        if(Auth::check()) {
            $validateData = $request->validated();
            $user = User::findOrFail($id);
            
            if(!$user) {
                return response()->json([
                    "message" => "not found"
                ], 404);
            }

            $user->update($validateData);
            return response()->json([
                "message" => 'ok',
                "data" => $user
            ], 200);
        }
    
    }


    public function destroy(string $id)
    {
        if(Auth::check()) {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                "message" => "Ok"
            ],200);
        }
    }
    
}
