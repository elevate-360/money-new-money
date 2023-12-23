<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        $user = User::select("userPassword")->where("userName", "=", $username);

        if (isset($user[0])) {
            if ($user[0]->userPassword == hash("sha512", $password)) {
                session()->put('user', 'Admin@Elevate360');
                return redirect()->route('index');
            } else {
                $passwordError = true;
                return redirect()->route('login', compact('passwordError'));
            }
        } else {
            $userError = true;
            return redirect()->route('login', compact('userError'));
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('index')->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }
}
