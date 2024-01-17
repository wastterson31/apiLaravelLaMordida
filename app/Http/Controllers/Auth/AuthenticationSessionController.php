<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class AuthenticationSessionController extends Controller
{
    public function create()
    {
        return view('UserLoginView');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|string'
        ]);
        $url = env('URL_SERVER_API');
        $response = Http::post($url . 'login', [
            'username' => $request->username,
            'password' => $request->password,
            'name' => 'browser',
        ]);
        if ($response->successful()) {
            $data = $response->json();
            // dd($data);
            $request->session()->put('api_token', $data['token']);
            $request->session()->put('user_name', $data['name']);
            $request->session()->put('username', $data['username']);
            $request->session()->put('user_id', $data['id']);
            $request->session()->regenerate();
            if ($data['rol'] == 'user') {
                return redirect()->route('Home');
            } else {
                return redirect()->route('Admin');
            }
        } else {
            return back()->withErrors([
                'message' => 'Credenciales invalidas'
            ]);
        }
    }


    public function destroy(Request $request)
    {
        //Destruir el archivo de sesión
        $request->session()->invalidate();
        //opener un nuevo token
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
