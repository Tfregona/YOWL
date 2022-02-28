@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-lg-10">
            <div class="blockquote text-center">
                <h3 id="blade-title">{{ $post->title }}</h3>
                <h5>{{ $post->content }}</h5>
                <p><small class="text-muted">Lien :</small> {{ $post->url }}</p>
            </div>

            <h3>Commentaires :</h3>

            @forelse ($comments as $item)
            <div class="card p-3 mt-2">
                <div class="profile-comment">
                    <div class="picture">
                        @if(!empty($item->user->avatar->filename))
                        <img src="{{asset($item->user->avatar->thumb_url)}}" width="30" class="user-img rounded-circle mr-2" alt="Photo de profil">
                        @else
                        <img src="https://www.avcesar.com/source/actualites/00/00/74/25/la-vraie-vie-de-dwayne-the-rock-johnson-avant-le-cinema_01014840.jpg" width="30" class="user-img rounded-circle mr-2">
                        @endif
                    </div>
                    <div class="nickname">
                        <small class="font-weight-bold text-primary">{{$item->user->nickname}}</small>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="user d-flex flex-row align-items-center">
                        <span class="comment-content">
                            <small class="font-weight-bold">{{ $item->content }}</small>
                        </span>

                    </div>
                    <small class="datetime">{{$item->updated_at}}</small>
                </div>
            </div>

            @empty
            <p>
                Pas encore de commentaires sous ce post
            </p>
            @endforelse


            @auth
            <!-- /.form -->
            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    Poster un commentaire avec le profil : {{ Auth::user()->nickname }}
                </div>

                <div class="card-body">
                    <form action="{{ route('comment.create', $post->id) }}" method="post">
                        @csrf

                        <div class="col-12">
                            <label for="text" class="form-label"><br>Content</label>
                            <input type="text" class="form-control" name="content" placeholder="Your comment" minlength="15">
                            @error('comment')
                            <div class="error">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <br><button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>

            @else

            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    <p> To post a comment you need to be authentified </p>
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('comment.create', $post->id) }}" method="post">
                        @csrf
                        <div class="col-12">
                            <label for="text" class="form-label"><br>Content</label>
                            <input type="text" class="form-control" name="content" placeholder="Your comment">
                            @error('comment')
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