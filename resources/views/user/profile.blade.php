@extends('layouts.home')

@section('content')

@if(session('success'))
<div id="alert-form" class="alert alert-success">{{session('success')}}</div>
@endif
<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-7">
            <div class="card p-3 py-4">
                <div class="text-center">

                    <h3>Bienvenue sur votre profil {{ $user->nickname }} !</h3>

                    @if(!empty($user->avatar->filename))
                    <img src="{{asset($user->avatar->thumb_url)}}" class="rounded-circle" alt="Photo de profil">
                    @else
                    <img src="https://www.avcesar.com/source/actualites/00/00/74/25/la-vraie-vie-de-dwayne-the-rock-johnson-avant-le-cinema_01014840.jpg"
                        width="100" class="rounded-circle">
                    @endif
                </div>

                <div class="text-center mt-3"> <span class="bg-secondary p-1 px-4 rounded text-white">{{ $user->type
                        }}</span>
                    <h5 class="mt-2 mb-0">{{ $user->nickname }}</h5> <span>{{ $user->email }}</span><br><span>N°{{ $user->id }}</span>

                    <div class="buttons">
                        <a class="btn btn-outline-primary px-4" href="{{ route('user.edit', $user->id) }}">Modifier votre profil</a>
                        @if($user->type === 'Admin')
                        <a class="btn btn-outline-primary px-4" href="{{ route('admin.index') }}">Page admin</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div id="admin-col" class="col-10 col-md-5">
                    <h3>Vos commentaires</h3>
                    <table>
                        <thead>
                        </thead>
                        <tbody>
                            @forelse ($comments as $item)
                            <tr>
                                <td><strong>{{ $item->id }}</strong> {{ $item->content }} |<a
                                        href="{{ route('postshow', $item->post_id) }}" class="link-info">Voir</a></td>
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
                                        <button type="submit" class="btn btn-link" id="delete-button"
                                            onclick="return confirm('Are you sure to delete the comment {{ $item->title }} ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <p>
                                No comment
                            </p>
                            @endforelse
                    </table>
                </div>

                <div id="admin-col" class="col-10 col-md-5">
                    <h3>Vos posts</h3>
                    <table>
                        <thead>
                        </thead>
                        <tbody>
                            @forelse ($posts as $item)
                            <tr>
                                <td><strong>{{ $item->id }}</strong> {{ $item->title }} |<a
                                        href="{{ route('postshow', $item->id) }}" class="link-info">Voir</a></td>
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
                                        <button type="submit" class="btn btn-link" id="delete-button"
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
            </div>
        </div>
    </div>
</div>
@stop