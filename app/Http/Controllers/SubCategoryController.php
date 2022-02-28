<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function show(subcategory $subcategory) //les articles de la categorie
    {
        $Posts = $subcategory->posts()->withCount('comments')->latest()->paginate(5);

        $data = [
            'title' => $subcategory->name,
            'description' => 'Les articles de la categorie ' . $subcategory->name,
            'category' => $subcategory,
            'produits' => $Posts,
        ];

        return view('subcategory.show', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'liste des posts';
    }
    public function list($id)
    {
        $categories = Category::all();
        $category = Category::find($id);
        $subcategories = Subcategory::where('cat_id', $id)->orderBy('title', 'desc')
            ->take(500)
            ->get();
        return view('subcategories', compact('subcategories', 'categories', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subcategorycreate(Request $request)
    {
        request()->validate([
            'cat_id' => 'required',
            'title' => 'required|min:5|max:191',
            'description' => 'required|min:1|max:400',
        ]);
        $subcategories = new Subcategory;
        $subcategories->title = request('title');
        $subcategories->cat_id = request('cat_id');
        $subcategories->description = request('description');
        $subcategories->slug = 'slug';

        $subcategories->save();

        $success = "Subategory Created !";
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
