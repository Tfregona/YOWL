@extends('layouts.home')

@section('content')
<div id="flex-container">

    @forelse ($categorieshome as $item)
    <p onclick="window.location.href='{{route('subcategories', $item->id)}}';"> {{ $item->title }}</p>
    @empty
    <p>
        Empty
    </p>
    @endforelse
</div>

<section class="horizontal">
    <div>
        <a class="link-light" href="{{route('categories')}}">Voir toutes les categories</a>
    </div>
</section>
<section class ="comments-section">
@forelse ($comments as $item)
<div id="home-comments" onclick="window.location.href='{{route('postshow', $item->post->id)}}';">
<p><i class="fas fa-comments"></i> {{$item->user->nickname}}</p>
    <p> {{ $item->content }}</p>
    <p class="comments-info"> Commentaire créé le {{ $item-> created_at}} <br> Mis à jour le {{$item -> updated_at}}</p>
</div>
@empty
<p>
    Empty
</p>
@endforelse
</section>
@stop