<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function index() {

    // }

    public function home()
    {
        $categories = Category::all();
        $categorieshome = Category::orderBy('created_at', 'asc')
            ->take(6)
            ->get();
        $comments = Comment::with('post')->with('user')->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        return view('homepage', compact('categorieshome', 'comments', 'categories',));
    }

    public function landing()
    {
        $categories = Category::all();
        return view('post.landing', compact('categories'));
    }
    public function postForm($id)
    {
        $categories = Category::all();
        $subcategories = Subcategory::where('cat_id', $id)->orderBy('title', 'desc')
            ->take(500)
            ->get();
        return view('post.form', compact('categories', 'subcategories'));
    }
    public function postCreate(Request $request)
    {
        $request->validate([
            'title' => 'required|min:1|max:40',
            'content' => 'required|min:1|max:400',
            'url' => 'required|min:1|max:400',
            'subcat_id' => 'required',
        ]);
        $post = new Post;
        $post->title = request('title');
        $post->content = request('content');

        $url = request('url');
        $domain = parse_url($url);
        $post->url = $domain['host'];

        $post->subcat_id = request('subcat_id');
        $post->user_id = Auth::user()->id;
        $post->slug = 'slug';

        $post->save();

        $success = "Post send !";
        return back()->withSuccess($success);
    }
}
