<?php

namespace App\Http\Controllers;

use App\Mail\LoginSuccess;
use App\Models\LoginLog;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent as Agent;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        $user = User::where("userLogin", "=", $username)->get();

        if (isset($user[0])) {
            if ($user[0]->userPassword == hash("sha512", $password)) {
                $agent = new Agent();
                $loginDetails = array(
                    "userId" => $user[0]->userId,
                    "ipAddress" => $request->ip(),
                    "browserInfo" => $request->userAgent(),
                    "operatingSystem" => $agent->platform(),
                    "deviceType" => $agent->device(),
                    "loginTime" => date("H:i:s"),
                    "loginDate" => date("Y-m-d")
                );
                LoginLog::upsert(
                    $loginDetails,
                    ['userId', 'loginDate'],
                    ['loginCount' => DB::raw('loginCount + 1')]
                );
                $customData = [
                    'date' => now()->format('j F, Y'),
                    'name' => $user[0]->userFirstName . " " . $user[0]->userLastName,
                ];
                try {
                    Mail::to($user[0]->userEmail)->send(new LoginSuccess($customData));
                } catch (Exception $e) {
                    Log::error('Login Mail Error For User ' . $user[0]->userLogin . ': ' . $e->getMessage());
                }
                session()->put('user', $user[0]);
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
