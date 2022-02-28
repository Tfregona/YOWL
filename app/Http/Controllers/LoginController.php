<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LoginController extends Controller
{
    /*     public function __construct()
    {
        $this->middleware('guest');
    } */
    public function index() //Form de connexion
    {
        $categories = Category::all();
        $data = [
            'title' => config('app.name') . ' - Login',
            'description' => 'Bienvenue sur votre compte ' . config('app.name'),
        ];
        return view('auth.login', $data, compact('categories'));
    }
    public function login() //Traite la connexion
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember = request()->has('remember');
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')], $remember)) {
            // The user is being remembered...
            /*         dd(Auth::user()); */
            return redirect('/profile');
        }
        return back()->withError('Mauvais identifiants, veuillez recommencer')->withInput();
    }
}
