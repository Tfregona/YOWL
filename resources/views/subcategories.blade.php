@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-lg-10">
            <div class="blockquote text-center">
                <h3 id="blade-title">Toutes les sous-catégories pour la categorie : {{ $category->title }}</h3>
            </div>
            <div class="card-group">
                @forelse ($subcategories as $item)
                <div id="flex-card-subcat">
                    <div class="card text-dark bg-light mb-3" style="min-width: 18rem;"
                        onclick="window.location.href='{{route('posts', $item->id)}}';">
                        <div class="divcomment">
                            <div class="card-header h5">{{ $item->title }}</div>

                            <div class="card-body">
                                <p class="card-text">{{ $item->description }}</p>
                            </div>
                        </div>
                    </div>
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
                        class="fas fa-plus-circle"></i>New Subcategory</button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create a Subcategory :
                                {{ Auth::user()->nickname }}</h5>
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
                                </div>
                                <br>
                                <label for="cat_id" class="form-label">Category</label>
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

                                <div class="col-12">
                                    <br><button type="submit" class="btn btn-primary">Submit</button>
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