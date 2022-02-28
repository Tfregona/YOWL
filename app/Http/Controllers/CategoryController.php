<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category) //les articles de la categorie
    {
        $subcategory = $category->posts()->withCount('comments')->latest()->paginate(5);

        $data = [
            'title' => $category->name,
            'description' => 'Les articles de la categorie ' . $category->name,
            'category' => $category,
            'subcategory' => $subcategory,
        ];

        return view('category.show', $data);
    }

    public function categories()
    {
        $categories = Category::all();
        return view('categoriesall', compact('categories'));
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function CreateCategories(Request $request) //Traite l'inscription
    {
        request()->validate([
            'title' => 'required|min:1|max:191',
            'description' => 'required|min:1|max:400',
        ]);

        $category = new Category;
        $category->title = request('title');
        $category->description = request('description');
        $category->slug = 'slug';


        $category->save();

        $success = "Category Created !";
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
