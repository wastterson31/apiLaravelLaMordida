<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('UserRegisterView', ['user' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:8',
            'address' => 'required',
            'phone' => 'required',
            'username' => 'required',
            'password' => ['required', 'confirmed'],
        ]);

        $url = env('URL_SERVER_API');
        $response = Http::post($url . 'register', [
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'rol' => 'user', // Puedes establecer el rol según tus necesidades
        ]);

        if ($response->successful()) {
            return redirect()
                ->route('login')
                ->with('message', 'Usuario registrado correctamente');
        } else {
            return back()
                ->withErrors([
                    'message' => 'Error al registrar los datos del usuario'
                ]);
        }
        // User::create([
        //
        // ]);


    }
}
