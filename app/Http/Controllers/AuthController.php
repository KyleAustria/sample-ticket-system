<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Firebase\JWT\JWT;

use Illuminate\Support\Facades\Validator;


class AuthController extends Controller {
    // API LOGIN

    public function apiLogin(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()){
            $errors = $validator->errors();
            return response()->json($errors,400);
        }

        try{
            $user = User::where('email',$request->input('email'))->firstOrFail();


            if(!empty($user) && Hash::check($request->input('password'),$user->password)){

                $userData = [
                    'id' => $user->id,
                    'email' => $user->email
                ];

                $secret = 'password123';

                $jwt = JWT::encode($userData, $secret,"HS256");

                return response()->json($jwt,200);
            }else{

                return response()->json('Unable to login',404);
            }
        }catch (\Throwable $th){

            return response()->json('Unable to login',404);
        }


    }
}
