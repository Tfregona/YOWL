<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class ResetController extends Controller
{
    public function index(string $token) // form de réinitialisation de mot de passe
    {
        $password_reset = DB::table('password_resets')->where('token', $token)->first();
        // dd($password_reset);

        abort_if(!$password_reset, 403);
        $categories = Category::all();
        $data = [
            'title' => $description = 'réinitialisation de mot de passe - ' . config('app.name'),
            'description' => $description,
            'password_reset' => $password_reset,
        ];
        return view('auth.reset', $data, compact('categories'));
    }
    public function reset() //Traitement de réinitialisation du mot de passe
    {
        request()->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|between:6,25|confirmed',
        ]);
        if (!DB::table('password_resets')
            ->where('email', request('email'))
            ->where('token', request('token'))->count()) {
            $error = 'Vérifiez l\'adresse e-mail.';
            return back()->withError($error)->withInput();
        }
        $user = user::whereEmail(request('email'))->firstOrFail();
        $user->password = bcrypt(request('password'));
        $user->save();

        DB::table('password_resets')->where('email', request('email'))->delete();

        $success = 'Votre mot de passe a été mis à jour !';
        return redirect()->route('login')->withSuccess($success);
    }
}
