@extends('layouts.home')

@section('content')
<div class="sidenav-admin">
  <a href="#Admin-categories"><i class="fas fa-folder-open"></i></a>
  <a href="#Admin-posts"><i class="far fa-comments"></i></a>
  <a href="#Admin-users"><i class="fas fa-users"></i></a>
</div>
<div class="container">
    <div class="row">
        @if(session('success'))
        <div id="alert-form" class="alert alert-success">{{session('success')}}</div>
        @endif

        <!-- CATEGORY -->

        <div id="admin-col" class="col-10 col-md-5">
            <h3 id="Admin-categories">Toutes les catégories</h3>

            <!-- Click on Modal Button -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
            Créer une catégorie
            </button>
            <br><br>

            <!-- Modal -->
            <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Créer une categorie : {{ Auth::user()->nickname
                                }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('post.category') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label"><br>Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Title"
                                        value="{{old('title')}}">
                                    @error('title')
                                    <div class="error">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label"><br>Description</label>
                                    <input type="text" class="form-control" name="description" placeholder="Description"
                                        value="{{old('description')}}">
                                    @error('description')
                                    <div class="error">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <br><button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <table>
                <tbody>
                    @forelse ($categories as $item)
                    <tr>
                        <td><strong>{{ $item->id }}</strong> {{ $item->title }} </td>
                        <td>
                            <a href="{{ route('category.edit', $item->id) }}">Modifier </a>
                        </td>
                        <td>
                            |
                        </td>
                        <td>
                            <form action="{{ route('category.destroy', $item->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-link"
                                    onclick="return confirm('Are you sure to delete the category {{ $item->title }} ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <p>
                        No categorie
                    </p>
                    @endforelse
                </tbody>
            </table>
        </div>


        <!-- SUBCATEGORY -->


        <div id="admin-col" class="col-10 col-md-5">
            <h3>Toutes les sous-catégories</h3>

            <!-- Click on Modal Button -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SubcategorymodalForm">
            Créer une sous-catégorie
            </button>
            <br><br>


            <!-- Modal -->
            <div class="modal fade" id="SubcategorymodalForm" tabindex="-1" aria-labelledby="SubcategoryModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="SubcategoryModalLabel">Créer une sous-catégorie : {{
                                Auth::user()->nickname }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('subcategory.create') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label"><br>Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Title"
                                        value="{{old('title')}}">
                                    @error('title')
                                    <div class="error">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label"><br>Content</label>
                                    <input type="text" class="form-control" name="description" placeholder="Description"
                                        value="{{old('description')}}">
                                    @error('description')
                                    <div class="error">{{$message}}</div>
                                    @enderror
                                </div><br>

                                <label for="cat_id" class="form-label">Categorie</label>
                                <select for="cat_id" name="cat_id" value="{{old('cat_id')}}" class="form-select"
                                    aria-label="Default select example">
                                    @forelse ($categories as $item)
                                    <option value="{{ $item->id }}"> {{ $item->title }}</option>
                                    @empty
                                    <p>
                                        Empty
                                    </p>
                                    @endforelse
                                </select>
                                @error('subcat_id')
                                <div class="error">{{$message}}</div>
                                @enderror

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <table>
                <thead>
                </thead>
                <tbody>
                    @forelse ($subcategories as $item)
                    <tr>
                        <td><strong>{{ $item->id }}</strong> {{ $item->title }} </td>
                        <td>
                            <a href="{{ route('subcategory.edit', $item->id) }}">Modifier</a>
                        </td>
                        <td>
                            |
                        </td>
                        <td>
                            <form action="{{ route('subcategory.destroy', $item->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-link"
                                    onclick="return confirm('Are you sure to delete the subcategory {{ $item->title }} ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <p>
                        No subcategorie
                    </p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- POSTS -->


    <div class="row">

        <div id="admin-col" class="col-10 col-md-5">
            <h3 id="Admin-posts">Tous les posts</h3>
            <table>
                <thead>
                </thead>
                <tbody>
                    @forelse ($posts as $item)
                    <tr>
                        <td><strong>{{ $item->id }}</strong> {{ $item->title }} </td>
                        <td>
                            <a href="{{ route('post.edit', $item->id) }}">Modifier</a>
                        </td>
                        <td>
                            |
                        </td>
                        <td>
                            <form action="{{ route('post.destroy', $item->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-link"
                                    onclick="return confirm('Are you sure to delete the post {{ $item->title }} ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <p>
                        No post
                    </p>
                    @endforelse
            </table>
        </div>


        <!-- COMMENTS -->


        <div id="admin-col" class="col-10 col-md-5">
            <h3>Tous les commentaires</h3>

            <table>
                <thead>
                </thead>
                <tbody>
                    @forelse ($comments as $item)
                    <tr>
                        <td><strong>{{ $item->id }}</strong> {{ $item->content }} </td>
                        <td>
                            <a href="{{ route('comment.edit', $item->id) }}">Modifier</a>
                        </td>
                        <td>
                            |
                        </td>
                        <td>
                            <form action="{{ route('comment.destroy', $item->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-link"
                                    onclick="return confirm('Are you sure to delete the comment {{ $item->title }} ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <p>
                        No comments
                    </p>
                    @endforelse
            </table>
        </div>


        <!-- USERS -->

        <div class="row">
            <div id="admin-col" class="col-10 col-md-5">
                <h3 id="Admin-users">Tous les utilisateurs</h3>


                <!-- Click on Modal Button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UsermodalForm">
                Créer un utilisateur
                </button>
                <br><br>


                <!-- Modal -->
                <div class="modal fade" id="UsermodalForm" tabindex="-1" aria-labelledby="UserModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="UserModalLabel">Créer un utilisateur : {{
                                    Auth::user()->nickname }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <form action="{{ route('AdminUser.create') }}" method="post">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="nickname" class="form-label"><br>Nickname</label>
                                        <input type="text" class="form-control" name="nickname" placeholder="Nickname"
                                            value="{{old('nickname')}}">
                                        @error('nickname')
                                        <div class="error">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label"><br>Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                            value="{{old('email')}}">
                                        @error('email')
                                        <div class="error">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="birthdate" class="form-label"><br>Birthdate</label>
                                        <input type="date" class="form-control" name="birthdate" placeholder="Birthdate"
                                            value="{{old('birthdate')}}">
                                        @error('birthdate')
                                        <div class="error">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label"><br>Password</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Password">
                                        @error('password')
                                        <div class="error">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type</label>
                                        <select for="type" name="type" class="form-select"
                                            aria-label="Default select example">
                                            <option>User</option>
                                            <option>Admin</option>
                                        </select>
                                        @error('content')
                                        <div class="error">{{$message}}</div>
                                        @enderror
                                    </div>


                                    <div class="modal-footer">
                                        <br><button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>




                <table>
                    <thead>
                    </thead>
                    <tbody>
                        @forelse ($users as $item)
                        <tr>
                            <td><strong>{{ $item->id }}</strong> {{ $item->nickname }} | {{ $item->type }} </td>
                            <td>
                                <a href="{{ route('AdminUser.edit', $item->id) }}">Modifier</a>
                            </td>
                            <td>
                                |
                            </td>
                            <td>
                                <form action="{{ route('AdminUser.destroy', $item->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-link"
                                        onclick="return confirm('Are you sure to delete the user {{ $item->nickname }} ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <p>
                            No user
                        </p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@stop