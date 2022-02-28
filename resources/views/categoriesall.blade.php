@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-lg-10">
            <div class="blockquote text-center">
                <h3 id="blade-title">Toutes les categories</h3>
            </div>
            <div id="flex-container" class="categories-all">
                @forelse ($categories as $item)

                <div id="card" onclick="window.location.href='{{route('subcategories', $item->id)}}';">
                    <p>{{ $item->title }}</p>
                    <p>{{ $item->description }}</p>
                </div>

                @empty
                <p>
                    Empty
                </p>
                @endforelse

            </div>

            @if(!Auth::guest() && Auth::user()->type === 'Admin')
            <!-- Click on Modal Button -->
            <div class="div-newbutton">
                <button id="new" class="button-os" data-bs-toggle="modal" data-bs-target="#modalForm"><i
                        class="fas fa-plus-circle"> </i>Nouvelle catégorie </button>
            </div>

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
                                    <br><button type="submit" class="btn btn-primary">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>


@stop