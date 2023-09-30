<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{

    // user register

    public function register(Request $request){

        $this->validationcheck($request);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'password' => Hash::make($request->password)
        ];

        User::create($data);

        $user = User::where('email',$request->email)->first();

        return response()->json([
            'user' => $user,
            'status' => 'success',
            'token' => $user->createToken(time())->plainTextToken
        ]);
    }

    // user login

    public function login(Request $request){
        $user = User::where('email',$request->email)->first();

        if(isset($user)){
            if(Hash::check($request->password, $user->password)){
                return response()->json([
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken
                ]);
            }else{
                return response()->json([
                    'user' => null,
                    'token' => null
                ]);
            }
        }else{
            return response()->json([
                'user' => null,
                'token' => null
            ]);
        }

    }

    //get all user
    public function getAllUser(){
        $users = User::select('email')->get();
        return response()->json([
            'email' => $users,
            'status'=> 'success'
        ]);
    }

    //validation check
    private function validationcheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:users',
            'address' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'

        ])->validate();
    }
}
