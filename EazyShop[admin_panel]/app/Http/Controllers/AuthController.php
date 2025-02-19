<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function Signup(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8',]
        ]);

        if($validator->fails()){
            return redirect()->route('signup')->withErrors($validator)->withInput();
        }

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = 'customer';
        $user->save();

        return redirect('/')->with('status', 'Registeration successfull!');
    }

    public function Signin(Request $request){
        $user = User::where('email', $request->input('email'))->first();
        if($user)
        {
            if (Hash::check($request->input('password'), $user->password)){
                session()->put('id', $user->id);
                
                if($user->role == 'admin'){
                    return redirect()->route('/admin')->with('success', 'Login Successfully!');
                }
                elseif($user->role == 'customer'){
                        return redirect('/')->with('success', 'Login Successfully!');
                }
            }
            else{
                return redirect()->back()->withErrors('error', 'Wrong password!');
            }
        }
        else
        {
            return redirect()->back()->withErrors(['error' => 'Credentials not match!']);
        }
    }

    public function logout(Request $request){
        session()->forget('id');
        return redirect()->route('signin')->with('success','Logout successfully!');
    }

}