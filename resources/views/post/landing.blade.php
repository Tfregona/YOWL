@extends('layouts.home')

@section('content')
<h3 class="blockquote text-center">Dans quelle catégorie voulez vous poster ?</h3>
<div id="flex-container">
    @forelse ($categories as $item)
    <p onclick="window.location.href='{{route('post.form', $item->id)}}';"> {{ $item->title }}</p>
    @empty
    <p>
        Empty
    </p>
    @endforelse
</div>
@stop