<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    public function index(Request $request){
        return view('back.pages.home');
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }

    public function resetform(Request $request, $token = null){
        $data = [
            'pageTitle' => 'Reset Password'
        ];

        return view('back.pages.auth.reset',$data)->with(['token' => $token, 'email' => $request->email]);
    }











    

    // public function password(){
    //     $password = Hash::make('password');
    //     dd($password);
    // }
}
