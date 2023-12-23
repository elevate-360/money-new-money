<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    public function view()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->input("username");
        $password = $request->input("password");

        if ($username == "Admin@Elevate360" && $password == "Money@Elevate360") {
            session()->put('user', 'Admin@Elevate360');
            return redirect()->route('index');
        } else {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('index')->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }
}
