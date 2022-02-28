@extends('layouts.home')

@section('content')

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-lg-10">
            <div class="blockquote text-center">
                <h3 id="blade-title">Les posts pour la sous-catégorie : {{ $subcategories->title }}</h3>
                <p><small class="text-muted">Description de la sous-catégorie :</small>
                    {{ $subcategories->description }}</p>
            </div>
            <div class="cards-posts">
                @forelse ($posts as $item)
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ $item->content }}</p>
                        <a href="{{route('postshow', $item->id)}}" class="btn btn-primary">Show</a>
                    </div>
                </div>
                @empty
                <p>
                    Pas encore de post
                </p>
                @endforelse
            </div>
            @if(session('success'))
            <div id="alert-form" class="alert alert-success">{{session('success')}}</div>
            @endif

            @auth
            <!-- /.form -->
            <div class="div-newbutton">
                <button id="new" class="button-os" data-bs-toggle="modal" data-bs-target="#modalForm"><i
                        class="fas fa-plus-circle"></i>Nouveau Post</button>
            </div>
            <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create a Subcategory : {{ Auth::user()->nickname }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body"> Créer un post avec le profil : {{ Auth::user()->nickname }}
                                    <form action="{{ route('posts.create', $subcategories->id) }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="url" class="form-label"><br>Url</label>
                                            <input type="text" class="form-control" name="url"
                                                placeholder="URL of Website" value="{{old('url')}}">
                                            @error('url')
                                            <div class="error">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="title" class="form-label"><br>Title</label>
                                            <input type="text" class="form-control" name="title"
                                                placeholder="Your title" value="{{old('title')}}">
                                            @error('title')
                                            <div class="error">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="content" class="form-label"><br>Content</label>
                                            <textarea type="text" class="form-control" name="content"
                                                placeholder="The content" value="{{old('content')}}"></textarea>
                                            @error('content')
                                            <div class="error">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <br><button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    <p> Pour poster vous devez être connecté </p>
                    <a class="nav-link" href="{{route('login')}}">Se connecter</a>
                </div>
                <div class="card-body">
                    <form method="post">
                        @csrf
                        <div class="col-12">
                            <label for="title" class="form-label"><br>Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Your title"
                                value="{{old('title')}}">
                            @error('title')
                            <div class="error">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="content" class="form-label"><br>Content</label>
                            <input type="text" class="form-control" name="content" placeholder="The content"
                                value="{{old('content')}}">
                            @error('content')
                            <div class="error">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="url" class="form-label"><br>Url</label>
                            <input type="url" class="form-control" name="url" placeholder="URL of Website"
                                value="{{old('url')}}">
                            @error('url')
                            <div class="error">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <br><button type="submit" class="btn btn-primary" disabled>Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>


@stop