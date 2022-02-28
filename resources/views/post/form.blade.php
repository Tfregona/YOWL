@extends('layouts.home')

@section('content')
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-lg-10">

      @if(session('success'))
      <div id="alert-form" class="alert alert-success">{{session('success')}}</div>
      @endif

      <div class="card card-outline-secondary my-4">
        <!-- /.form -->
        <div class="card-header">
          Créer un post avec le profil : {{ Auth::user()->nickname }}
        </div>

        <div class="card-body">
          <form method="post" action="{{ route('post.create.form') }}">
            @csrf
            @method('POST')

            <div class="col-12 mt-4">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" name="title" value="{{old('title')}}">
              @error('title')
              <div class="error">{{$message}}</div>
              @enderror

              <label for="content" class="form-label">Content</label>
              <input type="text" class="form-control" name="content" value="{{old('content')}}">
              @error('content')
              <div class="error">{{$message}}</div>
              @enderror

              <label for="url" class="form-label">Url</label>
              <input type="url" class="form-control" name="url" value="{{old('url')}}">
              @error('url')
              <div class="error">{{$message}}</div>
              @enderror

              <label for="subcat_id" class="form-label">Subcategory</label>
              <select for="subcat_id" name="subcat_id" value="{{old('subcat_id')}}" class="form-select"
                aria-label="Default select example">
                @forelse ($subcategories as $item)
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

            </div>

            <div class="col-12 mt-4">
              <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@stop