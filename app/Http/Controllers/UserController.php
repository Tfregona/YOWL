<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Storage, Image, Str;
use Exception;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('profile');
    }
    public function profile()
    {
        $categories = Category::all();
        $user = Auth::user();
        $comments = Comment::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')
            ->take(500)
            ->get();
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')
            ->take(500)
            ->get();
        return view('user.profile', compact('user', 'categories', 'comments', 'posts'));
    }
    public function edit($id) //formulaire de mise à jour des infos du user connecté
    {
        $categories = Category::all();
        $user = User::find($id);            
        if ($user->id === Auth::user()->id || Auth::user()->type === 'Admin'){
            return view('user.edit', compact('user', 'categories'));
        }
        else {
            return view('errors.notallowed');
        }
    }
    public function password() //formulaire d'update de password
    {
        $categories = Category::all();
        $data = [
            'title' => $description = 'Modifier mon mot de passe',
            'description' => $description,
            'user' => auth()->user(),
        ];
        return view('user.password', $data, compact('categories'));
    }
    public function updatePassword() //Mise à jour du mot de passe
    {
        request()->validate([
            'current' => 'required|password',
            'password' => 'required|between:6,25|same:password_confirm',
        ]);
        $user = auth()->user();
        $user->password = bcrypt(request('password'));
        $user->save();
        $success = 'Mot de passe mis à jour.';
        return back()->withSuccess($success);
    }


    public function store(Request $request) //sauvegarde des infos user
    {
        $request->validate([
            'nickname' => "required|string",
            'email' => "required|email|unique:users",
            'avatar' => "sometimes|nullable|image|mimes:jpeg,png,bmp",
        ]);
        // if(request()->hasFile('avatar') && request()->file('avatar')->isValid()){
        //     echo 'avatar posté';
        // }

        return back()->with('success', 'User created !');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nickname' => "required|string",
            'email' => "required|email|unique:users,id," . $id,
            'avatar' => "sometimes|nullable|image|mimes:jpeg,png,bmp|dimensions:min_width=1,min_height=1|max:1000000"
        ]);

        $user = User::find($id);

        $user->update([
            'nickname' => $request->nickname,
            'email' => $request->email,
        ]);
        if (request()->hasFile('avatar') && request()->file('avatar')->isValid()) {

            if (Storage::exists('avatars/' . $user->id)) {
                Storage::deleteDirectory('avatars/' . $user->id);
            }

            $ext = request()->file('avatar')->extension();

            $filename = Str::slug($user->nickname) . '-' . $user->id . '.' . $ext;
            // dd($filename);
            $path = request()->file('avatar')->storeAs('avatars/' . $user->id, $filename);
            // dd($path);
            $thumbnailImage = Image::make(request()->file('avatar'))->fit(100, 100, function ($constraint) {
                $constraint->upsize();
            })->encode($ext, 50);
            $thumbnailPath = 'avatars/' . $user->id . '/thumbnail/' . $filename;
            Storage::put($thumbnailPath, $thumbnailImage);

            $user->avatar()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'filename' => $filename,
                    'url' => Storage::url($path),
                    'path' => $path,
                    'thumb_url' => Storage::url($thumbnailPath),
                    'thumb_path' => $thumbnailPath,
                ]
            );
        }
        return back()->with('success', 'User updated !');
    }
    public function destroy(User $user) //suppression du compte utilisateur
    {
        abort_if($user->id !== auth()->id(), 403);

        $user->delete();

        return back()->with('success', 'User deleted !');
    }
}
