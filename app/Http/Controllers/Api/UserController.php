<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    public function login(Request $request){

        //dd($request->all());die();
        $user = User::where('email', $request->email)->first();

        if($user){

            $user-> update([
                'fcm' => $request->fcm,
            ]);

            if(password_verify($request->password, $user->password)){
                return response()->json([
                    'success' => 1,
                    'message' => 'Welcome '.$user->name,
                    'user' => $user
                ]);
            }
            return $this->error('Invalid Password');
        } 
        return $this->error('These credentials do not match our records.');
        
    }

    public function register(Request $request){
        //name,email,password,confirm password
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required|unique:users'
            
            //'c_password' => 'required|same:password'
           // 'confirmPassword' => 'required'
        ]);

        if($validation->fails()){
            $val = $validation->errors()->all();
            return $this->error($val[0]);
        }

        $user = User::create(array_merge($request->all(),[
            'password' => bcrypt($request->password)

        ]));

        if($user){
            return response()->json([
                'success' => 1,
                'message' => 'Welcome. Registeration Successfull!',
                //$user->name,
                'user' => $user
            ]);

        }

        return $this->error('Registeration Failed!');

    }

    public function error($message){
        return response()->json([
            'success' => 0,
            'message' => $message
        ]);
    }
    
}
