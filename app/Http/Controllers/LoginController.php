<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;
use View;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function login(Request $request)
    {
        return redirect('http://localhost/project-login/public/login?page_segment=http://localhost/project-one/public/admin/dashboard');
    }

    function login_view(Request $request)
    {
        return view('login');
    }

    function login_api(Request $request)
    {
        $login_data = [filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username' => $request->email, 'password' => $request->password];

        if (Auth::attempt($login_data))
        {
            return redirect('/admin/dashboard');
        } 
        else
        {
             return redirect()->back()->with('error','Invalid Username Or Password!');
        }
        
    }

   function check_login()
   {
        if(Auth::check() && isset(Auth::User()->id) && !empty(Auth::User()->id))
        {
            echo json_encode(['status'=>'success','user_id'=>Auth::User()->id]);
        } 
        else
        {
            echo json_encode(['status'=>'error','user_id'=>0]);
        }
    }

    function logout(Request $request) 
    {
        Auth::logout();
        return redirect('/');
    }
}