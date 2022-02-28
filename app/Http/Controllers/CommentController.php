<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class commentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'liste des comments';
    }


    public function list($id)
    {
        $categories = Category::all();
        $post = Post::find($id);
        $comments = Comment::with('user')->where('post_id', $id)->orderBy('updated_at', 'desc')
            ->take(500)
            ->get();
        return view('postshow', compact('comments', 'post', 'categories'));
    }
    /**
     * Show the form for creating a new resource.
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function CreateComment(Request $request, $id)
    {
        request()->validate([
            'content' => 'required|min:15|max:200',
        ]);
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $id;
        $comment->content = request('content');

        $comment->save();

        $success = "Comment send !";
        return back()->withSuccess($success);

        return back()->withError('Please write more than 15 caracters')->withInput();
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
        //Mise à jour du comment en BDD
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Supprimer le comment via l'id placé en url
    }
}
