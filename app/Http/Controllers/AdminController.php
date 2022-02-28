<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Storage, Image, Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $posts = Post::all();
        $comments = Comment::all();
        $users = User::all();
        if (Auth::user()->type === 'Admin'){
            return view('admin.adminpage', compact('categories', 'subcategories', 'posts', 'comments', 'users'));
        }
        else {
            return view('errors.notallowed');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AdminCreateUser(Request $request) //Traite l'inscription
    {
        request()->validate([
            'nickname' => 'required|min:5|max:191',
            'email' => 'required|email|unique:users',
            'birthdate' => 'required|date_format:Y-m-d|after_or_equal:1920-01-01|before_or_equal:2007-01-01',
            'password' => 'required|between:6,25',
            'type' => "required|string",

        ]);

        $user = new User;
        $user->nickname = request('nickname');
        $user->email = request('email');
        $user->birthdate = request('birthdate');
        $user->password = bcrypt(request('password'));
        $user->type = request('type');

        $user->save();

        $success = "Inscription success";
        return back()->withSuccess($success);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function categoryedit($id)
    {
        $categories = Category::all();
        $category = Category::find($id);
        if (Auth::user()->type === 'Admin'){
            return view('admin.edit.EditCategory', compact('category', 'categories'));
        }
        else {
            return view('errors.notallowed');
        }
    }

    public function subcategoryedit($id)
    {
        $categories = Category::all();
        $subcategory = Subcategory::find($id);
        if (Auth::user()->type === 'Admin'){
            return view('admin.edit.EditSubcategory', compact('subcategory', 'categories'));
        }
        else {
            return view('errors.notallowed');
        }
    }

    public function postedit($id)
    {
        $categories = Category::all();
        $post = Post::find($id);
        if ($post->user_id === Auth::user()->id || Auth::user()->type === 'Admin'){
            return view('admin.edit.EditPost', compact('post', 'categories')); 
        }
        else {
            return view('errors.notallowed');
        }
    }

    public function commentedit($id)
    {
        $categories = Category::all();
        $comment = Comment::find($id);
        if ($comment->user_id === Auth::user()->id || Auth::user()->type === 'Admin'){
            return view('admin.edit.EditComment', compact('comment', 'categories'));
        }
        else {
            return view('errors.notallowed');
        }
    }

    public function AdminUseredit($id)
    {
        $categories = Category::all();
        $user = User::find($id);
        return view('admin.edit.EditAdminUser', compact('user', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function categoryupdate(Request $request, $id)
    {
        $request->validate([
            'title' => "required|string|unique:categories,id," . $id,
            'description' => "required|string",
        ]);
        $category = Category::find($id);

        $category->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Category updated !');
    }

    public function subcategoryupdate(Request $request, $id)
    {
        $request->validate([
            'title' => "required|string|unique:categories,id," . $id,
            'description' => "required|string",
        ]);
        $category = Subcategory::find($id);

        $category->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Subcategory updated !');
    }

    public function postupdate(Request $request, $id)
    {
        $request->validate([
            'title' => "required|string|unique:categories,id," . $id,
            'content' => "required|string",
        ]);
        $category = Post::find($id);

        $category->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return back()->with('success', 'post updated !');
    }

    public function commentupdate(Request $request, $id)
    {
        $request->validate([
            'content' => "required|string",
        ]);
        $category = Comment::find($id);

        $category->update([
            'content' => $request->content,
        ]);

        return back()->with('success', 'comment updated !');
    }

    public function AdminUserupdate(Request $request, $id)
    {
        $request->validate([
            'nickname' => "required|string",
            'email' => "required|email|unique:users,id," . $id,
            'type' => "required|string",
            'avatar' => "sometimes|nullable|image|mimes:jpeg,png,bmp|dimensions:min_width=1,min_height=1|max:1000000"

        ]);
        $user = User::find($id);

        $user->update([
            'nickname' => $request->nickname,
            'email' => $request->email,
            'type' => $request->type,
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function categorydestroy(Category $category, $id)
    {
        $category = Category::find($id);

        $category->delete();
        return back()->with('success', 'Category deleted !');

    }


    public function subcategorydestroy(Subcategory $subcategory, $id)
    {

        $subcategory = Subcategory::find($id);

        $subcategory->delete();
        return back()->with('success', 'Subcategory deleted !');
    }



    public function postdestroy($id)
    {

        $post = Post::find($id);
        $post->delete();

        return back()->with('success', 'Post deleted !');
    }


    public function commentdestroy($id)
    {

        $comment = Comment::find($id);
        $comment->delete();

        return back()->with('success', 'Comment deleted !');
    }

    
    public function AdminUserdestroy($id)
    {

        $user = User::find($id);
        $user->delete();

        return back()->with('success', 'User deleted !');
    }
}
