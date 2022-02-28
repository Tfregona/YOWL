<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function logout() //Se déconnecter
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
