<?php

namespace App\Http\Controllers\Front;

use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function index(){
        return view('front.login.index');

    }

    public function store(Request $request){

        //Form validation

        $request->validate([

            'email'=>'email|required',
            'password'=>'required'
        ]);

        //check if exists

        $data=request(['email','password']);

        if(!auth()->attempt($data)){

            return back()->withErrors(['msg'=>'Wrong credentials, Please try again ! ']);
        }

        return redirect('/home');

    }

    public function logout(){

        auth()->logout();

        session()->flash('msg','You have been logged out succesfully');
        return redirect('/');

    }

}
