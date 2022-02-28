<?php

namespace App\Http\Controllers;

use Str, DB;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Notifications\PasswordResetNotification;

class ForgotPwController extends Controller
{
    /*     public function __construct()
    {
        $this->middleware('guest');
    } */
    public function index() //formulaire d'oubli de mot de passe
    {
        $categories = Category::all();
        $data = [
            'title' => $description = config('app.name') . ' - Vous avez oublié votre password',
            'description' => $description,
        ];

        return view('auth.forgotpw', $data, compact('categories'));
    }
    public function store() //vérif des datas et envoi de lien par mail
    {
        request()->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::uuid();

        DB::table('password_resets')->insert([
            'email' => request('email'),
            'token' => $token,
            // 'created_at'=>now(),
        ]);
        //envoi notification avec lien sécurisé
        $user = user::whereEmail(request('email'))->FirstOrFail();
        $user->notify(new PasswordResetNotification($token));
        $success = 'Vérifiez votre boîte mail et suivez les instructions.';
        return back()->withSuccess($success);
    }
}
