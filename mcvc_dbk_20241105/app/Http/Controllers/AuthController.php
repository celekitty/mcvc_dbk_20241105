<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validatedData = $request ->validate(rules: [
            'name' => ['required', 'string','max225'],
            'email'=> ['required','string','max:225','unique:users'],
            'password'=> ['required','string','min:8','max:20'],
        ]);

        $User = User::create([
            'name'=> $validatedData['name'],
            'email'=> $validatedData['email'],
            'password'=> Hash::make($validatedData['password']),
        ]);

        $token = $User->createToken('auth_token')->plainTextToken;

        return response()->json([
            "Success"=>true,
            "errors"=>[
                "code"=>0,
                "msg"=>""
            ],
            "data"=>[
                "access_token"=>$token,
                "token_type" => "Beaber"
            ],
            "msg"=>"Usuario creado satisfactoriamente",
            "count"=>1
    
        ]);

        public funtion logout (Request $request) {
            if(!Auth::attempt($request->only("email","password"))){
                return response()->json([
                    "success"=>false,
                    "errors"=>[
                        "code"=>401,
                        "msg"=> "No se reconocen las credenciales"
                    ],
                    "data"=>"",
                    "count"=> 0
                    
                ], 401);

                $user = User::where("email", $request->email)->firstOrFail();
                $token = $user->createToken("auth_token")->plainTextToken;

                return response()->json([
                    "success"=> true,
                    "errors"=>[
                        "code"=200,
                        "msg"=> ""
                    ],
                    "data"=>[
                        "access_token"=>$token,
                        "token_type"=> "Bearer"
                    ],
                    "msg"=>"Ha iniciado sesion correctamente",
                    "count"=> 1
                ],200);

                public function me(Request $request) {

                }
        }}}
    
    //
}
