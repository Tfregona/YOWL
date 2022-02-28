<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    public function list($id)
    {
        $categories = Category::all();
        $posts = Post::where('subcat_id', $id)->orderBy('updated_at', 'asc')
            ->take(500)
            ->get();
        $subcategories = Subcategory::find($id);

        return view('posts', compact('posts', 'categories', 'subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function CreatePost(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:1|max:40',
            'content' => 'required|min:1|max:400',
            'url' => 'required|min:1|max:200',
        ]);
        $post = new Post;
        $post->title = request('title');
        $post->content = request('content');

        $url = request('url');
        $domain = parse_url($url);
        $post->url = $domain['host'];

        $post->subcat_id = $id;
        $post->user_id = Auth::user()->id;
        $post->slug = 'slug';

        $post->save();

        $success = "Post send !";
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
        return 'je suis l\'article avec l\'id ' . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //user authentifié, éditer via formulaire
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
        //Mise à jour du post en BDD
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Supprimer le post via l'id placé en url
    }
}
