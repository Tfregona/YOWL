<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Storage, Image, Str;

class RegisterController extends Controller
{

    public function index() //Formulaire inscription
    {
        $categories = Category::all();
        $data = [
            'title' => config('app.name') . ' - Inscription',
            'description' => 'Inscription sur le site ' . config('app.name'),
        ];

        return view('auth.register', $data, compact('categories'));
    }

    public function register(Request $request) //Traite l'inscription
    {
        request()->validate([
            'nickname' => 'required|min:5|max:191',
            'email' => 'required|email|unique:users',
            'birthdate' => 'required|date_format:Y-m-d|after_or_equal:1920-01-01|before_or_equal:2007-01-01',
            'password' => 'required|between:6,25',
            'avatar' => "sometimes|nullable|image|mimes:jpeg,png,bmp",
        ]);

        $user = new User;
        $user->nickname = request('nickname');
        $user->email = request('email');
        $user->birthdate = request('birthdate');
        $user->password = bcrypt(request('password'));
        $user->type = 'User';


        $user->save();

        $success = "Inscription success";
        return back()->withSuccess($success);
    }
}
