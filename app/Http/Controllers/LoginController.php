<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $path = storage_path() . "/admin.json";
        $json = json_decode(file_get_contents($path));

        foreach ($json as $item) 
        {
            if ($item->email == $request->email) 
            {
                if ($item->password == $request->password) 
                {
                    Session::put('user', $request->all());

                    return redirect('/dashboard');
                }
                else
                {
                    return redirect()->back()->with('error', 'This credentials do not match our records!');
                }
            }
            else
            {
                return redirect()->back()->with('error', 'No user found with this email!');
            }
        }
    }
}
