<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Storage, Image, Str;

class NewsletterController extends Controller
{

    public function index() //Formulaire inscription newsletter
    {
        $categories = Category::all();
        $data = [
            'title' => config('app.name') . ' - Inscription',
            'description' => 'Inscription à la newsletter ' . config('app.name'),
        ];

        return view('newsletter', $data, compact('categories'));
    }

    public function newsletter(Request $request) //Traite l'inscription newsletter
    {
        request()->validate([
            'newsletter' => 'required|email',
        ]);

        $newsletter = new Newsletter;
        $newsletter->newsletter = request('newsletter');

        $newsletter->save();

        $success = "Vous êtes inscrit à la newsletter";
        return back()->withSuccess($success);
    }
}
