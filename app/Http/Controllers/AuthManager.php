<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthManager extends Controller
{
    function login(){
        return view('login');
}

function signup(){
    return view('signup');
}
function userLogin(Request $request) {
    // Validate the request data
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    // Get only email and password from the request
    $loginDetails = $request->only('email', 'password');

    // Attempt to authenticate the user
    if (Auth::attempt($loginDetails)) {
        // Redirect to the intended route on successful login
        return redirect()->route('/login');
    }

    // Redirect back to the login page with an error message on failure
    return redirect(route('login'))->with('loginError', 'Wrong Login');
}


function signuppost(Request $request){
    //return $request->all();
    $validator = Validator::make($request->all(),[
        'name'=> 'required',
        'email' => 'required',
        'password' => 'required',
    ]);
    if ($validator->fails()){
        return redirect(route('signup'))->withErrors($validator)->withInput();
    }

    
$data['name'] = $request->name;
$data['email'] = $request->email;
$data['password'] = Hash::make($request->password);

$user = User::create($data);
Auth::login($user);
return redirect()->intended(route('/'));
}
function logout(){
    Session:flush();
    Auth::logout();
    return redirect(route('login'));
    
}

}