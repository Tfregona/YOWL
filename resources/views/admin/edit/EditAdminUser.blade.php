@extends('layouts.home')

@section('content')

<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-lg-10">

      @if(session('success'))
      <div id="alert-form" class="alert alert-success">{{session('success')}}</div>
      @endif

      <!-- /.card -->

      <div class="card card-outline-secondary my-4">
        <div class="card-header">
          You're editing the user : {{ $user->nickname }}
        </div>

        <div class="card-body">
          <form method="post" enctype="multipart/form-data" action="{{ route('AdminUser.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="col-12 mt-4">

              <label for="nickname" class="form-label">Nickname</label>
              <input type="text" class="form-control" name="nickname" value="{{($user->nickname)}}">
              @error('content')
              <div class="error">{{$message}}</div>
              @enderror

              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" name="email" value="{{($user->email)}}">
              @error('content')
              <div class="error">{{$message}}</div>
              @enderror

              <label for="avatar" class="form-label">Avatar</label>
              <input type="file" class="form-control" name="avatar">
              @error('avatar')
              <div class="error">{{$message}}</div>
              @enderror
              @if(!empty($user->avatar->filename))
              <img src="{{asset($user->avatar->url)}}" width="400" alt="Photo de profil"><br>
              @endif

              <label for="type" class="form-label">Actual type : {{ $user->type }}</label>
              <select for="type" name="type" value="{{($user->type)}}" class="form-select"
                aria-label="Default select example">
                <option>User</option>
                <option>Admin</option>
              </select>
              @error('content')
              <div class="error">{{$message}}</div>
              @enderror

            </div>

            <div class="col-12 mt-4">
              <button type="submit" class="btn btn-primary">Update</button>
              <a href="{{ route('admin.index') }}" class="link-info">Return to admin page</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection