<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Session;
use Illuminate\Support\Str;

class CustomAuthController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }
    public function registration(Request $request)
    {
        return view('auth.registration');
    }
    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $res = $user->save();
        if ($res) {
            return back()->with('success', 'You have been registered successfully!');
        }
        else{
            return back()->with('fail', 'Something went wrong!');
        }
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);
        $user = User::where('email','=',$request->email)->first();
        if ($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            }
            else{
                return back()->with('fail', 'Your password is incorrect!');
            }
        }
        else{
            return back()->with('fail', 'This email is not registered!');
        }

    }
    public function dashboard(Request $request)
    {
        $data = array();
//        if(Session::has('loginId')){
//            $data = User::where('email','=',Session::get('loginId'))->first();
//        }
        return view('dashboard',compact('data'));
    }
    public function logoutUser()
    {
        return redirect('login');
    }
}
